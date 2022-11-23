<?php
require_once __DIR__ . '/../router.php';
ini_set('display_errors', 1);
$title = "Welcome";
require_once __DIR__ . '/header.php';
?>

<section>
  <h2>Log in</h2>
  <form action="/php-exam/log_in" method="POST">
    <label for="email">Email</label>
    <input type="text" name="email">
    <label for="password">Password</label>
    <input type="password" name="password">
    <button>Log in</button>
  </form>
  <?php if ($message) {
    out($message);
  } ?>
</section>

<section>
  <h2>Not a member? Sign up!</h2>
  <form action="/php-exam/create-user" method="POST">
    <label for="first_name">First name</label>
    <input type="text" name="first_name">
    <label for="last_name">Last name</label>
    <input type="text" name="last_name">
    <label for="email">Email</label>
    <input type="text" name="email">
    <label for="password">Password</label>
    <input type="password" name="password">
    <button>Sign up</button>
  </form>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>