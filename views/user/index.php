<?php
    $user = $this->data['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User</title>
</head>

<body>
  <? if ($user->getPhoto() != '') { ?>
    <img src="public/img/photos/<?= $user->getPhoto(); ?>" width="200" />
  <? } ?>

  <h2><?= ($user->getName() != '') ? $user->getName() : $user->getUsername(); ?></h2>

  <section id="info-user-container">
    <form action=<?= constant('URL'). '/user/updateName' ?> method="POST">
        <div class="section">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" autocomplete="off" required value="<?= $user->getName() ?>">
            <div><input type="submit" value="Change your name" /></div>
        </div>
    </form>

    <form action="<?= constant('URL'). '/user/updatePhoto' ?>" method="POST" enctype="multipart/form-data">
      <div class="section">
          <label for="photo">Profile photo</label>
          
          <? if(!empty($user->getPhoto())){ ?>
              <img src="<?= constant('URL') ?>/public/img/photos/<?= $user->getPhoto() ?>" width="50" height="50" />
          <? } ?>
          <input type="file" name="photo" id="photo" autocomplete="off" required>
          <div><input type="submit" value="Change your profile photo" /></div>
      </div>
    </form>
  </section>

  <section id="password-user-container">
    <form action="<?= constant('URL'). '/user/updatePassword' ?>" method="POST">
        <div class="section">
            <label for="current_password">Current password</label>
            <input type="password" name="current_password" id="current_password" autocomplete="off" required>
            <label for="new_password">New password</label>
            <input type="password" name="new_password" id="new_password" autocomplete="off" required>
            <div><input type="submit" value="Change your password" /></div>
        </div>
    </form>
  </section>

  <section id="budget-user-container">
    <form action="<?= constant('URL'). '/user/updateBudget' ?>" method="POST">
        <div class="section">
            <label for="budget">Define budget</label>
            <div><input type="number" name="budget" id="budget" autocomplete="off" required value="<?= $user->getBudget() ?>"></div>
            <div><input type="submit" value="Update budget" /></div>
        </div>
    </form>
  </section>

</body>

</html>