<?
    $stats = $this->data['stats']; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  </head>
  <body>
    <? require 'header.php'; ?>

    <div id="main-container">
      <? $this->showMessages(); ?>
      <div id="dashboard-container" class="container">
        <div id="left-container">
          <div id="panels-container">
            <div class="panel">
              <div class="title">USERS</div>
              <div class="datum"><?= $stats['count-users']; ?></div>
              <div class="description">Registered users</div>
            </div>
            <div class="panel">
              <div class="title">Expenses</div>
              <div class="datum"><?= $stats['count-expenses']; ?></div>
              <div class="description">Transactions</div>
            </div>
            <div class="panel">
              <div class="title">Expenses</div>
              <div class="datum">$<?= number_format($stats['max-expenses'], 2); ?></div>
              <div class="description">minimum spending</div>
            </div>
            <div class="panel">
              <div class="title">Expenses</div>
              <div class="datum">$<?= number_format($stats['avg-expenses'], 2); ?></div>
              <div class="description">maximum spending</div>
            </div>
            <div class="panel">
              <div class="title">Expenses</div>
              <div class="datum">$<?= number_format($stats['min-expenses'], 2); ?></div>
              <div class="description">Minimum spending</div>
            </div>
            <div class="panel">
              <div class="title">Categories</div>
              <div class="datum"><?= $stats['count-categories']; ?></div>
              <div class="description">Categories created</div>
            </div>
            <div class="panel">
              <div class="title">Categories</div>
              <div class="datum"><?= $stats['mostused-category']; ?></div>
              <div class="description">Most used categories</div>
            </div>
            <div class="panel">
              <div class="title">Categories</div>
              <div class="datum"><?= $stats['lessused-category']; ?></div>
              <div class="description">less used categories</div>
            </div>
          </div>
        </div>
        <div id="right-container">
          <div class="transactions-container">
            <section class="operations-container">
              <h2>Operations</h2>

              <button class="btn-main" id="new-category">
                <i class="material-icons">add</i>
                <span>Register new category</span>
              </button>
            </section>
          </div>
        </div>
      </div>
    </div>
    <script src="public/js/admin.js"></script>
  </body>
</html>
