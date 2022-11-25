<?php
require_once __DIR__ . '/../surrealdb.php';
require_once __DIR__ . '/../global_validation.php';

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$id = $_POST['id'];
$image = $_POST['image'];

$user_db = json_decode(surrealdb("SELECT first_name, last_name, email, id, image FROM user WHERE id = :id", ['id' => $id]), true)[1]['result'][0];

// Array destructuring 
[
'id_db' => $id,
'first_name_db' => $firstName,
'last_name_db' => $lastName,
'image_db' => $image,
'email_db' => $email
] = $user_db;

$query = <<<QUERY
UPDATE id: MERGE {
	name: 'Tobie',
	company: 'SurrealDB',
	skills: ['Rust', 'Go', 'JavaScript'],
}; 
QUERY;

$updated_user = surrealdb("UPDATE user WHERE id = :id SET first_name = 'x', last_name = 'xx'", ['id' => $id]);
echo $updated_user;


// UPDATE person MERGE {
// 	settings: {
// 		marketing: true,
// 	},
// };