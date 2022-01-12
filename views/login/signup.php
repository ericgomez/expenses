<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
</head>

<body>
  <?php $this->showMessages(); ?>
  <div id="login-main">

    <form action="<?= constant('URL'); ?>/signup/newUser" method="POST">
      <div></div>
      <h2>Register</h2>

      <p>
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
      </p>
      <p>
        <label for="password">password</label>
        <input type="text" name="password" id="password">
      </p>
      <p>
        <input type="submit" value="Login" />
      </p>
      <p>
        ¿You have an count? <a href="<?= constant('URL'); ?>">Login</a>
      </p>
    </form>
  </div>
</body>

</html>