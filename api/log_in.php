<?php
require_once __DIR__ . '/../surrealdb.php';
require_once __DIR__ . '/../global_validation.php';
require_once __DIR__ . '/../classes/User.php';

$user = new User();
$user->logIn();
