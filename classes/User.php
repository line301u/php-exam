<?php

class User
{
  public function logIn()
  {
    try {
      $email = _validate_email('email', "log_in", "email_password", "Wrong password or email");
      $password = _validate_password('password', "log_in", "email_password", "Wrong password or email");

      $user = json_decode(surrealdb('SELECT * FROM user WHERE email=:email', ['email' => $email]), true)[1]['result'][0];
      $password_hashed = $user['password'];

      if (password_verify($password, $password_hashed)) {
        // Set the user id in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['first_name'] . ' ' . $user['last_name'];
        $_SESSION['is_admin'] = $user['is_admin'];

        header('Location: /php-exam/home');
      } else {
        $_SESSION['form_errors']["log_in"]['email_password'] = "Wrong password or email";
        header("Location: /php-exam");
      }
    } catch (Exception $ex) {
      echo $ex;
    }
  }

  public function logOut()
  {
    try {
      session_destroy();
      header("Location: /php-exam");
    } catch (Exception $ex) {
      echo $ex;
    }
  }

  public function signUp()
  {
    try {
      $first_name = _validate_first_name("first_name", "create_user");
      $last_name = _validate_last_name("last_name", "create_user");
      $email = _validate_email("email", "create_user");
      $password = password_hash(_validate_password("password", "create_user"), PASSWORD_DEFAULT);

      $if_email_exists = json_decode(surrealdb("SELECT * FROM user WHERE email=:email", ['email' => $email]), true)[1]['result'][0];

      if (empty($if_email_exists)) {
        surrealdb('CREATE user SET first_name=:first_name, last_name=:last_name, email=:email, password=:password, is_admin=:is_admin', ['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'password' => $password, 'is_admin' => false]);

        // Set the user id in session
        $user = json_decode(surrealdb("SELECT * FROM user WHERE email=:email", ['email' => $email]), true)[1]['result'][0];
        $_SESSION["user_id"] = $user['id'];
        $_SESSION["is_admin"] = $user['is_admin'];
        $_SESSION["name"] = $user['first_name'] . ' ' . $user['last_name'];
        header("Location: /php-exam/home");
      } else {
        $_SESSION[_SESSION_FORM_ERRORS]["create_user"]['email'] = "Email already exists";
        header("Location: {$_SERVER['HTTP_REFERER']}");
      }
    } catch (Exception $ex) {
      echo $ex;
    }
  }

  public function update()
  {
    try {
      $id = $_POST['id'];
      $logged_in_user = $_SESSION['user_id'];
      $form_name = "update_user";

      if (!isset($id)) {
        header("Location: /php-exam/404.php");
        exit();
      }

      if ($id !== $logged_in_user) {
        header("Location: /php-exam/user/$id");
        exit();
      }

      $image = _validate_image("image", $form_name, "error");
      $first_name = _validate_first_name("first_name", $form_name, "error");
      $last_name = _validate_last_name("last_name", $form_name, "error");
      $email = _validate_email("email", $form_name, "error");

      $current_user_profile = json_decode(surrealdb("SELECT first_name, last_name, email, image FROM user WHERE id = :id", ['id' => $id]), true)[1]['result'][0];
      $lets = [];
      $sets = [];

      if ($current_user_profile['first_name'] !== $first_name) {
        $lets['first_name'] = $first_name;
        array_push($sets, 'first_name = :first_name');
      }

      if ($current_user_profile['last_name'] !== $last_name) {
        $lets['last_name'] = $last_name;
        array_push($sets, 'last_name = :last_name');
      }

      if ($current_user_profile['email'] !== $email) {
        $is_email_taken = count(json_decode(surrealdb("SELECT email FROM user WHERE email = :email", ['email' => $email]), true)[1]['result']);

        if ($is_email_taken) {
          $_SESSION[_SESSION_FORM_ERRORS]['update_user']['error'] = "Email is already taken";
          header("Location: /php-exam/user/$id");
          exit();
        } else {
          $lets['email'] = $email;
          array_push($sets, 'email = :email');
        }
      }

      if (!is_null($image)) {
        $lets['image'] = $image;
        array_push($sets, 'image = :image');
      }

      if (count($lets) == 0) {
        header("Location: /php-exam/user/$id");
        exit();
      }

      $lets['id'] = $id;
      $sets = implode(', ', $sets);
      $query = "UPDATE :id SET {$sets}";

      surrealdb($query, $lets);
      $_SESSION[_SESSION_FORM_SUCCESSES]['update_user']['success'] = "Successfully updated user";
      header("Location: /php-exam/user/$id");
      exit();
    } catch (Exception $ex) {
      echo $ex;
      exit();
    }
  }

  public function delete()
  {
    try {
      $id = $_POST["id"];

      if (!isset($id)) {
        header("Location: /php-exam/404.php");
        exit();
      }

      if (!$_SESSION['is_admin'] && $id != $_SESSION['user_id']) {
        header("Location: /php-exam/home");
        exit();
      }

      surrealdb("DELETE :id", ['id' => $id]);

      if ($_SESSION['is_admin']) {
        header("Location: /php-exam/home");
      } else {
        $user = new User();
        $user->logOut();
      }
      exit();
    } catch (Exception $ex) {
      echo $ex;
    }
  }

  public function getOne($id)
  {
    $user = json_decode(surrealdb("SELECT first_name, last_name, email, id, image FROM user WHERE id = :id", ['id' => $id]), true)[1]['result'][0];
    return $user;
  }

  public function getAll()
  {
    $users = json_decode(surrealdb('SELECT * FROM user'), true)[0]['result'];
    return $users;
  }
}
