<?
    $user = $this->data['user'];
    $dates = $this->data['dates'];
    $categories = $this->data['categories'];
?>

<link rel="stylesheet" href="<?= constant('URL') ?>/public/css/history.css">
    <? require_once 'views/dashboard/header.php'; ?>

    <div id="main-container">
    <? $this->showMessages();?>
        <div id="history-container" class="container">
            <?
                // if(isset($_GET['message'])){
                //     if($_GET['message'] === 'success'){
                //         showSuccess('Expense removed successfully');
                //     }else{
                //         showError('There was an error in the operation. Try again later');
                //     }
                // }
             ?>
            <div id="history-options">
                <h2>Expense history</h2>
                <div id="filters-container">
                    <div class="filter-container">
                        <select id="sdate" class="custom-select">
                            <option value="">See all dates</option>
                            <?
                                $options = $dates;
                                foreach($options as $option){
                                  echo "<option value=$option >".$option."</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="filter-container">
                        <select id="scategory" class="custom-select">
                            <option value="">See all categories</option>
                            <?
                                $options = $categories;
                                foreach($options as $option){
                                  echo "<option value=$option >".$option."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>   
            </div>
            
            <div id="table-container">
                <table width="100%" cellpadding="0">
                    <thead>
                        <tr>
                        <th data-sort="title" width="35%">Title</th>
                        <th data-sort="category">Category</th>
                        <th data-sort="date">Date</th>
                        <th data-sort="amount">Quantity</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="databody">
                        
                    </tbody>
                </table>
            </div>
            
        </div>

    </div>

