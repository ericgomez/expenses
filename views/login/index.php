<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="<?= constant('URL'); ?>/public/css/login.css">
</head>

<body>
    <?php require 'views/header.php'; ?>
    <?php $this->showMessages();?>

    <div id="login-main">
        <form action="<?= constant('URL'); ?>/login/authenticate" method="POST">
        <div><?php (isset($this->errorMessage))?  $this->errorMessage : '' ?></div>
            <h2>Login</h2>

            <p>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" autocomplete="off">
            </p>
            <p>
                <label for="password">password</label>
                <input type="password" name="password" id="password" autocomplete="off">
            </p>
            <p>
                <input type="submit" value="Login" />
            </p>

            <p>
                ¿You have an count? <a href="<?= constant('URL'); ?>/signup">Register</a>
            </p>
        </form>
    </div>
</body>

</html>