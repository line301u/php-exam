<?php
require_once __DIR__ . '/../surrealdb.php';

$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

try {
    if (!isset($email)) {
        header("Location: /php-exam");
    }
    if (!isset($password)) {
        header("Location: /php-exam");
    }
    // surrealdb('');

    // header("Location: /php-exam");
} catch (Exception $ex) {
    echo $ex;
}


echo "HI";
// echo $email;
// echo $password;

// if (password_verify($user_password, $hashed_password)) {
//     echo 'You are logged in';
// } else {
//     echo 'Wrong password or email';
// }
