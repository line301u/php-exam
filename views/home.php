<?php
ini_set('display_errors', 1);
$title = "Home";
$isAdmin = "";
require_once __DIR__ . '/header.php';
require_once __DIR__ . '/../surrealdb.php';

// check if user is logged in (if session is set)
if (!isset($_SESSION['user_id'])) {
  header('Location: /php-exam');
}

// Check if user is admin
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
  $isAdmin = "true";
}

?>

<section class="container mt-4">
  <a href="/php-exam/log-out" class="btn btn-outline-dark">Log out</a>
  <h1 class="display-1 pb-4 pt-4">Home</h1>
  <h2 class="mt-4">All users</h2>

  <?php


  try {
    $users = json_decode(surrealdb('SELECT * FROM user'), true)[0]['result'];

    foreach ($users as $user) { ?>
      <div class="user d-flex align-items-center border gap-4 mt-4 p-2">
        <a class="col-2" href="<?= "/user/" . $user['id'] ?>">
          <?php if (isset($user['image'])): ?>
            <img style="object-fit:cover;"  src="<?= out($user['image']) ?>" alt="User profile picture">
          <?php else: ?>
            <img class="img-fluid rounded" style="object-fit:cover;" src="./images/fallback-profile-pic.png" alt="User profile picture">
          <?php endif ?>
        </a>
          <div class="col-auto flex-grow-1">
            <a class="col-2 text-reset text-decoration-none" href="<?= "/user/" . $user['id'] ?>">
              <h3 class="h5"><?= $user['first_name'] . " " . $user['last_name']?></h3>
            </a>
          <p class="m-0"><?= $user['email'] ?></p>
        </div>
        <?php if ($isAdmin) : ?>
          <form action="/delete-user" method="POST" class="flex-shrink-1">
            <input class="id" name="id" type="hidden" value=<?= $user['id'] ?>>
            <button type="submit" class="btn btn-dark delete_user">Delete user</button>
          </form>
        <?php endif ?>
      </div>
  <?php }
  } catch (Exception $ex) {
    out($ex);
  }
  ?>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>