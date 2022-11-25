<?php
require_once __DIR__ . '/../surrealdb.php';
require_once __DIR__ . '/../global_validation.php';

$form_name = "create_user";

try {
    $first_name = _validate_first_name("first_name", $form_name);
    $last_name = _validate_last_name("last_name", $form_name);
    $email = _validate_email("email", $form_name);
    $password = password_hash(_validate_password("password", $form_name), PASSWORD_DEFAULT);

    $ifEmailExists = json_decode(surrealdb("SELECT * FROM user WHERE email=:email", ['email' => $email]), true)[1]['result'][0];

    if (empty($ifEmailExists)) {
        surrealdb('CREATE user SET first_name=:first_name, last_name=:last_name, email=:email, password=:password', ['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'password' => $password]);

        // Set the user id in session
        $user = json_decode(surrealdb("SELECT * FROM user WHERE email=:email", ['email' => $email]), true)[1]['result'][0];
        $_SESSION["user_id"] = $user['id'];
        header("Location: /php-exam/home");
    } else {
        $_SESSION[_SESSION_FORM_ERRORS][$form_name]['email'] = "Email already exists";
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
} catch (Exception $ex) {
    echo $ex;
}
