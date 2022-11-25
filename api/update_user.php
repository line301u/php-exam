<?php
require_once __DIR__ . '/../surrealdb.php';
require_once __DIR__ . '/../global_validation.php';

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$id = $_POST['id'];
$loggedInUser = $_SESSION['user_id'];

if (!isset($id)) {
    header("Location: /404.php");
    exit();
}

$lets = [
    'id' => $id,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email,
    'image' => $image 
];

$image = _validate_image($_POST['image']);
// if ($id === $loggedInUser){
//     try {
        
//         $updated_user = surrealdb("UPDATE :id SET first_name = :first_name, last_name = :last_name, email = :email, image = :image", $lets);
//         header("Location: /user/$id");
//         exit();
//     } catch (Exception $ex) {
//         echo $ex;
//         exit();
//     }
// } else {
//     header("Location: /user/$id");
// }