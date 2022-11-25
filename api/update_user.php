<?php

use function PHPSTORM_META\type;

require_once __DIR__ . '/../surrealdb.php';
require_once __DIR__ . '/../global_validation.php';

$id = $_POST['id'];
$loggedInUser = $_SESSION['user_id'];

if (!isset($id)) {
    header("Location: /404.php");
    exit();
}

// $image = _validate_image("image");
$first_name = _validate_first_name("first_name");
$last_name = _validate_first_name("last_name");
$email = _validate_first_name("email");

$lets = [
    'id' => $id,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email,
    'image' => "kalkun.png" 
];

if ($id === $loggedInUser){
    try {
        surrealdb("UPDATE :id SET first_name = :first_name, last_name = :last_name, email = :email, image = :image", $lets);
        header("Location: /user/$id");
        exit();
    } catch (Exception $ex) {
        echo $ex;
        exit();
    }
} else {
    header("Location: /user/$id");
}