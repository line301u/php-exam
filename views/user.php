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

$title = "User - {$firstName} {$lastName}";
require_once __DIR__ . '/header.php';

?>

<a href="/php-exam/home">Go back</a>

<?php

if ($id == $_SESSION['user_id']) {
?>
  <form action="/php-exam/delete-user" method="POST" class="flex-shrink-1 pt-4 d-flex align-items-center gap-3">
    <input class="id" name="id" type="hidden" value=<?= $id ?>>
    <button type="submit" class="btn btn-outline-danger delete_user">Delete user</button>
  </form>
<?php
}



// Array destructuring 
[
  'id' => $id,
  'first_name' => $firstName,
  'last_name' => $lastName,
  'image' => $image,
  'email' => $email
] = $user;

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
        <input class="form-control" type="file" name="image">
      </label>
      <button type="submit" class="btn btn-dark d-inline align-self-end">Edit</button>
    </form>
  </div>
</article>



<?php

require_once __DIR__ . '/footer.php';

?>