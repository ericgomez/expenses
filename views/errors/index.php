<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Error 404</title>
</head>

<body>
  
  <?php require 'views/header.php'; ?>
    <div class="error-container">
        <div class="error-info">
        <h1 class="error404">404</h1> 
        <p>
            
            The page you are looking for does not exist.
            <br />
            <a href="<?= constant('URL') ?>">Return to home page</a>
        </p>   
        </div>
        
    </div>
</body>

</html>