<?
    $categories = $this->data['categories'];
?>


<link rel="stylesheet" href="<?= constant('URL'); ?>/public/css/expense.css">


<form id="form-expense-container" action="expenses/newExpense" method="POST">
    <h3>Record new expense
</h3>
    <div class="section">
        <label for="amount">Quantity</label>
        <input type="number" name="amount" id="amount" autocomplete="off" required>
    </div>
    <div class="section">
        <label for="title">Description</label>
        <div><input type="text" name="title" autocomplete="off" required></div>
    </div>
    
    <div class="section">
        <label for="date">Expense date</label>
        <input type="date" name="date" id="" required>
    </div>    

    <div class="section">
        <label for="category">Category</label>
            <select name="category" id="" required>
            <? 
                foreach ($categories as $cat) {
            ?>
                <option value="<?= $cat->getId() ?>"><?= $cat->getName() ?></option>
                    <?
                }
            ?>
            </select>
    </div>    

    <div class="center">
        <input type="submit" value="new expense">
    </div>
</form>