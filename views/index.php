<?php
ini_set('display_errors', 1); // Remove later
$title = "Welcome";
require_once __DIR__ . '/header.php';
require_once __DIR__ . '/../global_validation.php';

// check if user is logged in (if session is set)
if (isset($_SESSION['user_id'])) {
  header('Location: /php-exam/home');
}

?>

<div class="py-5" style="max-width:992px;">
  <div class="row">

    <section class="col-md-6 py-3">
      <h2>Log in</h2>
      <form action="/php-exam/log-in" method="POST">

        <div class="mb-3">
          <label class="form-label" for="email">Email address</label>
          <input class="form-control" type="email" name="email" placeholder="Email address">
        </div>

        <div class="mb-3">
          <label class="form-label" for="password">Password</label>
          <input class="form-control" type="password" name="password" placeholder="Password">
        </div>

        <?php if (isset($_SESSION[_SESSION_FORM_ERRORS]['log_in']['email_password'])) : ?>
          <div class="invalid-feedback mb-3" style="display: block;">
            <?= $_SESSION[_SESSION_FORM_ERRORS]['log_in']['email_password'] ?>
          </div>
        <?php endif ?>

        <button class="btn btn-outline-dark">Log in</button>
      </form>

    </section>

    <section class="col-md-6 py-3">
      <h2>Not a member? Sign up!</h2>
      <form action="/php-exam/create-user" method="POST">
        <div class="mb-3">
          <label class="form-label" for="first_name">First name</label>
          <?php if (isset($_SESSION[_SESSION_FORM_ERRORS]['create_user']['first_name'])) : ?>
            <input class="form-control is-invalid" type="text" name="first_name" placeholder="First name">
            <div class="invalid-feedback">
              <?= $_SESSION[_SESSION_FORM_ERRORS]['create_user']['first_name'] ?>
            </div>
          <?php else : ?>
            <input class="form-control" type="text" name="first_name" placeholder="First name">
          <?php endif ?>
        </div>

        <div class="mb-3">
          <label class="form-label" for="last_name">Last name</label>
          <?php if (isset($_SESSION[_SESSION_FORM_ERRORS]['create_user']['last_name'])) : ?>
            <input class="form-control is-invalid" type="text" name="last_name" placeholder="Last name">
            <div class="invalid-feedback">
              <?= $_SESSION[_SESSION_FORM_ERRORS]['create_user']['last_name'] ?>
            </div>
          <?php else : ?>
            <input class="form-control" type="text" name="last_name" placeholder="Last name">
          <?php endif ?>
        </div>

        <div class="mb-3">
          <label class="form-label" for="email">Email</label>
          <?php if (isset($_SESSION[_SESSION_FORM_ERRORS]['create_user']['email'])) : ?>
            <input class="form-control is-invalid" type="email" name="email" placeholder="Email address">
            <div class="invalid-feedback">
              <?= $_SESSION[_SESSION_FORM_ERRORS]['create_user']['email'] ?>
            </div>
          <?php else : ?>
            <input class="form-control" type="email" name="email" placeholder="Email address">
          <?php endif ?>
        </div>

        <div class="mb-3">
          <label class="form-label" for="password">Password</label>
          <?php if (isset($_SESSION[_SESSION_FORM_ERRORS]['create_user']['password'])) : ?>
            <input class="form-control is-invalid" type="password" name="password" placeholder="Password">
            <div class="invalid-feedback">
              <?= $_SESSION[_SESSION_FORM_ERRORS]['create_user']['password'] ?>
            </div>
          <?php else : ?>
            <input class="form-control" type="password" name="password" placeholder="Password">
          <?php endif ?>
        </div>

        <button class="btn btn-dark">Sign up</button>
      </form>
    </section>
  </div>
</div>

<?php
require_once __DIR__ . '/footer.php';
?>