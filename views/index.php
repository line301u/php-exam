<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>Welcome</h1>

  <section>
    <h2>Log in</h2>
    <form action="/php-exam/log_in" method="POST">
      <label for="email">Email</label>
      <input type="text" name="email">
      <label for="password">Password</label>
      <input type="password" name="password">
      <button>Log in</button>
    </form>
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



</body>

</html>