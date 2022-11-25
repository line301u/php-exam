<?php 
ini_set('display_errors', 1);
$title = "Home";
require_once __DIR__ . '/header.php';
print_r($_SESSION);
?>

<section class="container mt-4">
  <h1 class="display-1 pb-4 pt-4">Home</h1>
  <h2 class="mt-4">All users</h2>

  <?php
  require_once __DIR__.'/../surrealdb.php';
  $isAdmin = "true"; // FIX !

  try {
    $users = json_decode(surrealdb('SELECT * FROM user'), true)[0]['result'];

    foreach($users as $user){ ?>
      <div class="user d-flex align-items-center border gap-4 mt-4 p-2">
        <?php if (isset($user['image'])): ?>
          <img class="col-2" style="object-fit:cover;"  src="<?= out($user['image']) ?>" alt="User profile picture">
        <?php else: ?>
          <img class="img-fluid rounded col-2" style="object-fit:cover;" src="./images/fallback-profile-pic.png" alt="User profile picture">
        <?php endif ?>
        <div class="col-auto flex-grow-1">
          <h3 class="h5"><?= $user['first_name'] . " " . $user['last_name']?></h3>
          <p class="m-0"><?= $user['email'] ?></p>
        </div>
        <?php if ($isAdmin): ?>
          <form action="/delete-user" method="POST" class="flex-shrink-1">
            <input class="id" name="id" type="hidden" value=<?= $user['id']?>>
            <button type="submit" class="btn btn-dark delete_user">Delete user</button>
          </form>
        <?php endif ?>
      </div>
  <?php }
  } catch (Exception $ex){
    out($ex);
  }
  ?>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>