<?
    $expenses               = $this->data['expenses'];
    $totalThisMonth         = $this->data['totalAmountThisMonth'];
    $maxExpensesThisMonth   = $this->data['maxExpensesThisMonth'];
    $user                   = $this->data['user'];
    $categories             = $this->data['categories'];

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense App - Dashboard</title>
</head>

<body>
    <? require 'header.php'; ?>

    <div id="main-container">
        <? $this->showMessages();?>
        <div id="expenses-container" class="container">

            <div id="left-container">

                <div id="expenses-summary">
                    <div>
                        <h2>Welcome
                            <?= $user->getName() ?>
                        </h2>
                    </div>
                    <div class="cards-container">
                        <div class="card w-100">
                            <div class="total-budget">
                                <span class="total-budget-text">
                                    Balance Sheet of the Month
                                </span>
                            </div>
                            <div class="total-expense">
                                <?
                                    if($totalThisMonth === null){
                                        // showError('There was a problem loading the information');
                                    }else{?>
                                <span class="<?= ($user->getBudget() < $totalThisMonth)? 'broken': '' ?>">$
                                    <?= number_format($totalThisMonth, 2);?>
                                </span>
                                <? }?>


                            </div>
                        </div>
                    </div>
                    <div class="cards-container">
                        <div class="card w-50">
                            <div class="total-budget">
                                <span class="total-budget-text">
                                    of
                                    $
                                    <?= number_format($user->getBudget(),2) . ' monthly you have left';
                                    ?>
                                </span>
                            </div>
                            <div class="total-expense">
                                <?
                                    if($totalThisMonth === null){
                                        // showError('There was a problem loading the information');
                                    }else{?>
                                <span>
                                    <?
                                                $gap = $user->getBudget() - $totalThisMonth;
                                                if($gap < 0){
                                                    echo "-$" . number_format(abs($user->getBudget() - $totalThisMonth), 2);
                                                }else{
                                                    echo "$" . number_format($user->getBudget() - $totalThisMonth, 2);
                                                }
                                            
                                        ?>
                                </span>
                                <? }?>
                            </div>
                        </div>

                        <div class="card w-50">
                            <div class="total-budget">
                                <span class="total-budget-text">Your biggest expense this month</span>

                            </div>
                            <div class="total-expense">
                                <?
                                    if($maxExpensesThisMonth === null){
                                        // showError('There was a problem loading the information');
                                    }else{?>
                                <span>$
                                    <?= number_format($maxExpensesThisMonth, 2);?>
                                </span>
                                <? }?>
                            </div>
                        </div>

                    </div>
                </div>

                <div id="chart-container">
                    <div id="chart">

                    </div>
                </div>

                <div id="expenses-category">
                    <h2>Monthly expenses by category</h2>
                    <div id="categories-container">
                        <?
                            if($categories === null){
                                // showError('Data not available at the moment.');
                            }else{
                                foreach ($categories as $category ) { ?>
                        <div class="card w-30 bs-1"
                            style="background-color: <? echo $category['category']->getColor() ?>">
                            <div class="content category-name">
                                <?= $category['category']->getName() ?>
                            </div>
                            <div class="title category-total">$
                                <?= $category['total'] ?>
                            </div>
                            <div class="content category-count">
                                <p>
                                    <?
                                                $count = $category['count'];
                                                if($count == 1){
                                                    echo $count . " transaction";
                                                }else{
                                                    echo $count . " transactions";
                                                }
                                            ?>
                                </p>
                            </div>
                        </div>
                        <?   }
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div id="right-container">
                <div class="transactions-container">
                    <section class="operations-container">
                        <h2>Operations</h2>

                        <button class="btn-main" id="new-expense">
                            <i class="material-icons">add</i>
                            <span>Register new expense</span>
                        </button>
                        <a href="<?= constant('URL'); ?>user#budget-user-container">Define budget<i
                                class="material-icons">keyboard_arrow_right</i></a>
                    </section>

                    <section id="expenses-recents">
                        <h2>Most recent records</h2>
                        <?
                         if($expenses === null){
                            // showError('Error loading data');
                        }else if(count($expenses) == 0){
                            // showInfo('No transactions');
                        }else{
                            foreach ($expenses as $expense) { ?>
                        <div class='preview-expense'>
                            <div class="left">
                                <div class="expense-date">
                                    <?= $expense->getDate(); ?>
                                </div>
                                <div class="expense-title">
                                    <?= $expense->getTitle(); ?>
                                </div>
                            </div>
                            <div class="right">
                                <div class="expense-amount">$
                                    <?= number_format($expense->getAmount(), 2);?>
                                </div>
                            </div>
                        </div>

                        <?
                            }
                            echo '<div class="more-container"><a href="expenses">See all expenses<i class="material-icons">keyboard_arrow_right</i></a></div>';
                        } 
                     ?>
                    </section>
                </div>
            </div>


        </div>

    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="public/js/dashboard.js"></script>

</body>

</html>