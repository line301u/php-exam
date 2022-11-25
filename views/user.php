<?php
require_once __DIR__ . '/../surrealdb.php';

// check if user is logged in (if session is set)
if (!isset($_SESSION['user_id'])) {
  header('Location: /php-exam');
}

$user = json_decode(surrealdb("SELECT first_name, last_name, email, image FROM user WHERE id = :id", ['id' => $id]), true)[1]['result'][0];

if (!$user) {
  header("Location: /php-exam/404");
  exit();
}


// Array destructuring 
[
  'first_name' => $firstName,
  'last_name' => $lastName,
  'image' => $image,
  'email' => $email
] = $user;

$title = "User - {$firstName} {$lastName}";
require_once __DIR__ . '/header.php';
?>

<article class="card mx-auto mt-5" style="width: 18rem;">
  <?php if ($image) : ?>
    <img class="card-img-top" src="<?= $image ?>" alt="User profile picture">
  <?php else : ?>
    <img class="card-img-top" src="../images/fallback-profile-pic.png" alt="User profile picture">
  <?php endif ?>

  <div class="card-body">
    <h1 class="card-title"><?= "{$firstName} {$lastName}" ?></h1>
    <a class="card-text d-block mb-3" href="mailto:<?= $email ?>"><?= $email ?></a>
    <a href="#" class="btn btn-outline-primary">Edit</a>
  </div>
</article>

<?php if ($id == $_SESSION['user_id']) { ?>
  <form action="/php-exam/delete-user" method="POST" class="flex-shrink-1">
    <input class="id" name="id" type="hidden" value=<?= $id ?>>
    <button type="submit" class="btn btn-outline-danger delete_user">Delete user</button>
  </form>
<?php
}
?>

<?php

require_once __DIR__ . '/footer.php';

?>