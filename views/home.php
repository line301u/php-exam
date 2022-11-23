<?php 
ini_set('display_errors', 1);
$title = "Home";
require_once __DIR__ . '/header.php';
?>

<section>
  <h1>Home</h1>
  <h2>All users</h2>

  <?php
  require_once __DIR__.'/../surrealdb.php';

  $isAdmin = "true";

  try {
    $users = json_decode(surrealdb('SELECT * FROM user'), true)[0]['result'];

    foreach($users as $user){ ?>
      <div class="d-flex">
        <?php if (isset($user['image'])): ?>
          <img src="<?= out($user['image']) ?>" alt="User profile picture">
        <?php else: ?>
          <img src="./images/fallback-profile-pic.png" alt="User profile picture">
        <?php endif ?>
        <div>
          <h4><?= $user['first_name'] ?></h4>
          <h4><?= $user['last_name'] ?></h4>
          <p><?= $user['email'] ?></p>
        </div>
        <?php if ($isAdmin): ?>
          <a href="/php-exam/user/<?php echo $user['id'] ?>">Delete user</a>
        <?php endif ?>
      </div>
  <?php }
  } catch (Exception $ex){
    out($ex);
  }
  ?>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>