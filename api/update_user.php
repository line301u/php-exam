<?php

require_once __DIR__ . '/../surrealdb.php';
require_once __DIR__ . '/../global_validation.php';

$id = $_POST['id'];
$loggedInUser = $_SESSION['user_id'];
$form_name = "update_user";

if (!isset($id)) {
    header("Location: /php-exam/404.php");
    exit();
}

if ($id !== $loggedInUser) {
    header("Location: /php-exam/user/$id");
    exit();
}

$image = _validate_image("image", $form_name, "error");
$first_name = _validate_first_name("first_name", $form_name, "error");
$last_name = _validate_last_name("last_name", $form_name, "error");
$email = _validate_email("email", $form_name, "error");

try {
    $currentUserProfile = json_decode(surrealdb("SELECT first_name, last_name, email, image FROM user WHERE id = :id", ['id' => $id]), true)[1]['result'][0];
    $lets = [];
    $sets = [];

    if ($currentUserProfile['first_name'] !== $first_name) {
        $lets['first_name'] = $first_name;
        array_push($sets, 'first_name = :first_name');
    }

    if ($currentUserProfile['last_name'] !== $last_name) {
        $lets['last_name'] = $last_name;
        array_push($sets, 'last_name = :last_name');
    }

    if ($currentUserProfile['email'] !== $email) {
        $isEmailTaken = count(json_decode(surrealdb("SELECT email FROM user WHERE email = :email", ['email' => $email]), true)[1]['result']);

        if ($isEmailTaken) {
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
