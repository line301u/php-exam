<?php
require_once __DIR__ . '/../surrealdb.php';
require_once __DIR__ . '/../global_validation.php';
ini_set('display_errors', 1); // Remove later

try {
    echo "You logged out";

    session_destroy();
    header("Location: /");
} catch (Exception $ex) {
    echo $ex;
}
