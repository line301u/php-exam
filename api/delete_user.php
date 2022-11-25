<?php
require_once __DIR__.'/../surrealdb.php';

$id = $_POST["id"];
$isAdmin = true; // FIX !
echo $id;

if (!isset($id)) {
    header("Location: /404.php");
    exit();
}

if ($isAdmin){
    try {
        surrealdb("DELETE :id", ['id'=>$id]);
        header("Location: /home");
        exit();
    } catch(Exception $ex){
        echo $ex;
    }
}
