<?php
require_once __DIR__ . '/../surrealdb.php';

$id = $_POST["id"];
$isAdmin = "";
echo $id;
// Check if user is admin
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
    $isAdmin = "true";
}

if (!isset($id)) {
    header("Location: /404.php");
    exit();
}

if ($isAdmin) {
    try {
        surrealdb("DELETE :id", ['id' => $id]);
        header("Location: /php-exam/home");
        exit();
    } catch (Exception $ex) {
        echo $ex;
    }
}

if ($id == $_SESSION['user_id']) {
    try {
        surrealdb("DELETE :id", ['id' => $id]);
        header("Location: /");
        exit();
    } catch (Exception $ex) {
        echo $ex;
    }
}
