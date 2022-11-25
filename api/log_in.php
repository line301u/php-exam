<?php
require_once __DIR__ . '/../surrealdb.php';
require_once __DIR__ . '/../global_validation.php';
ini_set('display_errors', 1); // Remove later

try {
    $email = _validate_email("email");
    $password = _validate_password("password");

    $user = json_decode(surrealdb("SELECT * FROM user WHERE email=:email", ['email' => $email]), true)[1]['result'][0];
    $password_hashed = $user['password'];

    if (password_verify($password, $password_hashed)) {
        echo 'You are logged in';

        // Set the user id in sesstion
        $_SESSION["user_id"] = $user['id'];

        header("Location: /php-exam/home");
    } else {
        echo 'Wrong password or email';
        header("Location: /php-exam");
    }
} catch (Exception $ex) {
    echo $ex;
}
