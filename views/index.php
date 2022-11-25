<?php
ini_set('display_errors', 1); // Remove later
$title = "Welcome";
require_once __DIR__ . '/header.php';
?>

<div class="container py-5" style="max-width:992px;">
  <div class="row">

    <section class="col-md-6">
      <h2>Log in</h2>
      <form action="/php-exam/log-in" method="POST">

        <div class="mb-3">
          <label class="form-label" for="email">Email</label>
          <input class="form-control" type="text" name="email" placeholder="Email address">
        </div>

        <div class="mb-3">
          <label class="form-label" for="password">Password</label>
          <input class="form-control" type="password" name="password" placeholder="Password">
        </div>

        <button class="btn btn-outline-dark">Log in</button>
      </form>
      <?php if ($message) {
        out($message);
      } ?>
    </section>

    <section class="col-md-6">
      <h2>Not a member? Sign up!</h2>
      <form action="/php-exam/create-user" method="POST">
        <div class="mb-3">
          <label class="form-label" for="first_name">First name</label>
          <input class="form-control" type="text" name="first_name" placeholder="First name">
        </div>

        <div class="mb-3">
          <label class="form-label" for="last_name">Last name</label>
          <input class="form-control" type="text" name="last_name" placeholder="Last name">
        </div>

        <div class="mb-3">
          <label class="form-label" for="email">Email</label>
          <input class="form-control" type="text" name="email" placeholder="Email address">
        </div>

        <div class="mb-3">
          <label class="form-label" for="password">Password</label>
          <input class="form-control" type="password" name="password" placeholder="Password">
        </div>

        <button class="btn btn-dark">Sign up</button>
      </form>
    </section>
  </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>