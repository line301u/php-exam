<?php
require_once __DIR__ . '/../surrealdb.php';
require_once __DIR__ . '/../global_validation.php';
ini_set('display_errors', 1);

$email = $_POST['email'];
$password = $_POST['password'];
try {
    // if (!isset($email) or empty($email)) {
    //     // header("Location: /php-exam");
    //     echo "Email is empty";
    //     exit();
    // }
    // if (!isset($password) or empty($password)) {
    //     // header("Location: /php-exam");
    //     echo "Password is empty";
    //     exit();
    // }
    $user_email = _validate_user_email();
    $password = _validate_user_password();
    echo $password;
    echo $user_email;

    $user = json_decode(surrealdb("SELECT * FROM user WHERE email=:email", ['email' => $email]), true)[1]['result'][0];
    $password_hashed = $user['password'];

    if (password_verify($password, $password_hashed)) {
        echo 'You are logged in';
        exit();
        // header("Location: /php-exam/home");
    } else {
        echo 'Wrong password or email';
        exit();
        // header("Location: /php-exam");
    }

    $_SESSION["user_id"] = $user['id'];
} catch (Exception $ex) {
    echo $ex;
}
