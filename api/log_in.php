<?php
require_once __DIR__ . '/../surrealdb.php';
ini_set('display_errors', 1); // Remove later

$email = $_POST['email'];
$password = $_POST['password'];
try {
    if (!isset($email) or empty($email)) {
        header("Location: /php-exam");
    }
    if (!isset($password) or empty($password)) {
        header("Location: /php-exam");
    }
    $user = json_decode(surrealdb("SELECT * FROM user WHERE email=:email", ['email' => $email]), true)[1]['result'][0];

    if (password_verify($password, $password_hashed)) {
        echo 'You are logged in';
        header('Location: /php-exam/home');
    } else {
        echo 'Wrong password or email';
        $message = 'Wrong password or email';
        header('Location: /php-exam/$message');
    }
} catch (Exception $ex) {
    echo $ex;
}
