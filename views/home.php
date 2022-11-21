<?php 
$title = "Home";
require_once __DIR__ . '/header.php'; 
?>

<section>
  <h1>Home</h1>
  <h2>All users</h2>

  <?php
  require_once __DIR__.'/../surrealdb.php';
  ini_set('display_errors', 1);

  try{
    $users = surrealdb('SELECT * FROM user');
    echo $users;

  } catch (Exception $ex){
      echo $ex;
  }
  ?>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>