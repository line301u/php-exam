<?php
require_once __DIR__ . '/../surrealdb.php';
require_once __DIR__ . '/../global_validation.php';
ini_set('display_errors', 1); // Remove later

$form_name = 'log_in';

try {
    $email = _validate_email('email');
    $password = _validate_password('password');

    $user = json_decode(surrealdb('SELECT * FROM user WHERE email=:email', ['email' => $email]), true)[1]['result'][0];
    $password_hashed = $user['password'];

    if (password_verify($password, $password_hashed)) {
        echo 'You are logged in';

        // Set the user id in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['first_name'] . ' ' . $user['last_name'];
        $_SESSION['is_admin'] = $user['is_admin'];

        echo ' is admin: ' . $user['is_admin'];

        header('Location: /home');
    } else {
        $_SESSION['form_errors'][$form_name]['email_password'] = "Wrong password or email";
        header("Location: /");
    }
} catch (Exception $ex) {
    echo $ex;
}
