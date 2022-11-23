<?php
require_once __DIR__ . '/../surrealdb.php';
ini_set('display_errors', 1);

$email = $_POST['email'];
$password = $_POST['password'];
try {
    if (!isset($email) or empty($email)) {
        header("Location: /php-exam");
    }
    if (!isset($password) or empty($password)) {
        header("Location: /php-exam");
    }
    echo $email . "<br>";
    $user = json_decode(surrealdb("SELECT * FROM user WHERE email=:email", ['email' => $email]), true)[1]['result'][0];
    echo json_encode($user) . "<br>";
    echo $password . "<br>";
    $password_hashed = $user['password'];
    echo $password;
    echo $password_hashed;

    if (password_verify($password, $password_hashed)) {
        echo 'You are logged in';
        header("Location: /php-exam/home");
    } else {
        echo 'Wrong password or email';
        header("Location: /php-exam");
    }
} catch (Exception $ex) {
    echo $ex;
}
