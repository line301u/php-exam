<?php
require_once __DIR__ . '/../surrealdb.php';
require_once __DIR__ . '/../global_validation.php';
require_once __DIR__ . '/header.php';
require_once __DIR__ . '/../classes/User.php';

// check if user is logged in (if session is set)
if (!isset($_SESSION['user_id'])) {
  header('Location: /php-exam');
}

$user = new User();
$user = $user->getOne($id);

if (!$user) {
  header("Location: /php-exam/404");
  exit();
}

// Array destructuring 
[
  'first_name' => $first_name,
  'last_name' => $last_name,
  'image' => $image,
  'email' => $email
] = $user;

$title = "User - {$first_name} {$last_name}";
?>

<div class="d-flex justify-content-between align-items-center">
  <a href="/php-exam/home">Go back</a>
  <?php if ($id == $_SESSION['user_id'] || $_SESSION['is_admin']) : ?>
    <form action="/php-exam/delete-user" method="POST" class="flex-shrink-1 d-flex align-items-center gap-3">
      <input class="id" name="id" type="hidden" value="<?= out($id) ?>" />
      <button type="submit" class="btn btn-outline-danger delete_user">Delete user</button>
    </form>
  <?php endif ?>
</div>


<?php if (isset($_SESSION[_SESSION_FORM_SUCCESSES]['update_user']['success'])) : ?>
  <div class="alert alert-success my-3">
    <?= $_SESSION[_SESSION_FORM_SUCCESSES]['update_user']['success'] ?>
  </div>
<?php endif ?>

<?php if (isset($_SESSION[_SESSION_FORM_ERRORS]['update_user']['error'])) : ?>
  <div class="alert alert-danger my-3">
    <?= $_SESSION[_SESSION_FORM_ERRORS]['update_user']['error'] ?>
  </div>
<?php endif ?>

<article class="card mx-auto mt-4" style="width: 18rem;">
  <?php if ($image) : ?>
    <img class="card-img-top" style="object-fit:cover; max-height:200px" src="../images/<?= out($image) ?>" alt="User profile picture">
  <?php else : ?>
    <img class="card-img-top mh-100" src="../images/fallback-profile-pic.png" alt="User profile picture">
  <?php endif ?>

  <div class="card-body">
    <h1 class="card-title"><?= out("{$first_name} {$last_name}") ?></h1>
    <a class="card-text d-block mb-3 link-dark" href="mailto:<?= out($email) ?>"><?= out($email) ?></a>

    <?php if ($id == $_SESSION['user_id']) : ?>
      <h2 class="h5 mt-4 pt-3 border-top">Edit your profile</h2>
      <form class="d-flex flex-column" action="/php-exam/update-user" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= out($id) ?>" />
        <label class="form-label">First name
          <input class="form-control d-inline" type="text" name="first_name" value="<?= out($first_name) ?>" />
        </label>
        <label class="form-label">Last name
          <input class="form-control d-inline" type="text" name="last_name" value="<?= out($last_name) ?>" />
        </label>
        <label class="d-block form-label">Email
          <input class="form-control d-inline" type="text" name="email" value="<?= out($email) ?>" />
        </label>
        <label class="mb-4 d-block form-label">Profile picture
          <input class="form-control" type="file" name="image" />
        </label>
        <button type="submit" class="btn btn-dark d-inline align-self-end">Edit</button>
      </form>
    <?php endif ?>
  </div>
</article>



<?php

require_once __DIR__ . '/footer.php';

?>