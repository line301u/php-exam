<?php
require_once __DIR__ . '/../surrealdb.php';

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

try {
    if (!isset($first_name)) {
        header("Location: /php-exam");
    }
    if (!isset($last_name)) {
        header("Location: /php-exam");
    }
    if (!isset($email)) {
        header("Location: /php-exam");
    }
    if (!isset($password)) {
        header("Location: /php-exam");
    }

    surrealdb('CREATE user SET first_name=:first_name, last_name=:last_name, email=:email, password=:password', ['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'password' => $password]);
    header("Location: /php-exam");
} catch (Exception $ex) {
    echo $ex;
}
