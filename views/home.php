<?php
$title = "Home";
require_once __DIR__ . '/header.php';
require_once __DIR__ . '/../surrealdb.php';
require_once __DIR__ . '/../classes/User.php';

// check if user is logged in (if session is set)
if (!isset($_SESSION['user_id'])) {
  header('Location: /php-exam');
}

?>

<section class="container mt-4">
  <h1 class="display-1 pb-4 pt-4">Home</h1>
  <h2 class="mt-4">All users</h2>

  <?php

  try {
    $users = new User();
    $users = $users->getAll();

    foreach ($users as $user) { ?>
      <div class="user d-flex align-items-center border gap-4 mt-4 p-2">
        <a class="col-2" href="<?= "/php-exam/user/" . $user['id'] ?>">
          <?php if (isset($user['image'])) : ?>
            <img class="w-100 h-100" style="object-fit:cover;" src="./images/<?= $user['image'] ?>" alt="User profile picture">
          <?php else : ?>
            <img class="img-fluid rounded" style="object-fit:cover;" src="./images/fallback-profile-pic.png" alt="User profile picture">
          <?php endif ?>
        </a>
        <div class="col-auto flex-grow-1">
          <a class="col-2 text-reset text-decoration-none" href="<?= "/php-exam/user/" . $user['id'] ?>">
            <h3 class="h5"><?= $user['first_name'] . " " . $user['last_name'] ?></h3>
          </a>
          <p class="m-0"><?= $user['email'] ?></p>
        </div>
        <?php if ($_SESSION['is_admin']) : ?>
          <form action="/php-exam/delete-user" method="POST" class="flex-shrink-1">
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