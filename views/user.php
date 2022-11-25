<?php
require_once __DIR__ . '/../surrealdb.php';
require_once __DIR__ . '/../global_validation.php';

// check if user is logged in (if session is set)
if (!isset($_SESSION['user_id'])) {
  header('Location: /');
}

$user = json_decode(surrealdb("SELECT first_name, last_name, email, id, image FROM user WHERE id = :id", ['id' => $id]), true)[1]['result'][0];

if (!$user) {
  header("Location: /404");
  exit();
}


// Array destructuring 
[
  'id' => $id,
  'first_name' => $firstName,
  'last_name' => $lastName,
  'image' => $image,
  'email' => $email
] = $user;

$title = "User - {$firstName} {$lastName}";
require_once __DIR__ . '/header.php';
?>
<article class="card mx-auto mt-4" style="width: 18rem;">
  <?php if ($image) : ?>
    <img class="card-img-top" src="<?= $image ?>" alt="User profile picture">
  <?php else : ?>
    <img class="card-img-top" src="../images/fallback-profile-pic.png" alt="User profile picture">
  <?php endif ?>

  <div class="card-body">
    <h1 class="card-title"><?= "{$firstName} {$lastName}" ?></h1>
    <a class="card-text d-block mb-3" href="mailto:<?= $email ?>"><?= $email ?></a>
    
    <h2 class="h5 mt-4 pt-3 border-top">Edit your profile</h2>
    <form class="d-flex flex-column" action="/update-user" method="POST">
      <input type="hidden" name="id" value=<?= "{$id}" ?>>
      <label class="form-label">First name
        <input class="form-control d-inline" type="text" name="first_name" value=<?= "{$firstName}" ?>>
      </label>
      <label class="form-label">Last name
        <input class="form-control d-inline" type="text" name="last_name" value=<?= "{$lastName}" ?>>
      </label>
      <label class="d-block form-label">Email
        <input class="form-control d-inline" type="text" name="email" value=<?= "{$email}" ?>>
      </label>
      <label class="mb-4 d-block form-label">Profile picture
        <h1><?= $image ?></h1>
        <input class="form-control" type="file" name="image" value=<?= $image ? $image : 'fallback-profile-pic.png' ?>>
      </label>
      <button type="submit" class="btn btn-dark d-inline align-self-end">Edit</button>
    </form>
  </div>
</article>

<?php

require_once __DIR__ . '/footer.php';

?>