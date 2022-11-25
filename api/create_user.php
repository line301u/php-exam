<?php
require_once __DIR__ . '/../surrealdb.php';
require_once __DIR__ . '/../global_validation.php';


try {
    $first_name = _validate_first_name("first_name");
    $last_name = _validate_last_name("last_name");
    $email = _validate_email("email");
    $password = password_hash(_validate_password("password"), PASSWORD_DEFAULT);

    $ifEmailExists = json_decode(surrealdb("SELECT * FROM user WHERE email=:email", ['email' => $email]), true)[1]['result'][0];

    if (empty($ifEmailExists)) {
        echo "EMAIL IS FINE";
        surrealdb('CREATE user SET first_name=:first_name, last_name=:last_name, email=:email, password=:password, is_admin=:is_admin', ['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'password' => $password, 'is_admin' => false]);

        // Set the user id in session
        $user = json_decode(surrealdb("SELECT * FROM user WHERE email=:email", ['email' => $email]), true)[1]['result'][0];
        $_SESSION["user_id"] = $user['id'];
        $_SESSION["is_admin"] = $user['is_admin'];
        header("Location: /php-exam/home");
    } else {
        echo "EMAIL ALREADY EXISTS";
    }
} catch (Exception $ex) {
    echo $ex;
}
