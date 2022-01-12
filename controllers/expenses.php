<?
require_once 'models/expensesmodel.php';
require_once 'models/categoriesmodel.php';

class Expenses extends SessionController{
    private $user;

    function __construct(){
        parent::__construct();

        $this->user = $this->getUserSessionData();
    }

    function render(){

        $this->view->render('expenses/index', [
            'user' => $this->user,
            'dates' => $this->getDateList(),
            'categories' => $this->getCategoryList()
        ]);
    }

    function newExpense(){
        if(!$this->existPOST(['title', 'amount', 'category', 'date'])){
            $this->redirect('dashboard', ['error' => ErrorMessages::ERROR_EXPENSES_NEWEXPENSE_EMPTY]);
            return;
        }

        if($this->user == null){
            $this->redirect('dashboard', ['error' => ErrorMessages::ERROR_EXPENSES_NEWEXPENSE]);
            return;
        }

        $expense = new ExpensesModel();

        $expense->setTitle($this->getPost('title'));
        $expense->setAmount((float)$this->getPost('amount'));
        $expense->setCategoryId($this->getPost('category'));
        $expense->setDate($this->getPost('date'));
        $expense->setUserId($this->user->getId());

        $expense->save();

        $this->redirect('dashboard', ['success' => SuccessMessages::SUCCESS_EXPENSES_NEWEXPENSE]);
    }

    // new expense UI
    function create(){
        $categories = new CategoriesModel();

        $this->view->render('expenses/create', [
            "categories" => $categories->getAll(),
            "user" => $this->user
        ]);
    } 

    function getCategoryId(){
        $joinExpensesCategoriesModel = new JoinExpensesCategoriesModel();

        $categories = $joinExpensesCategoriesModel->getAll($this->user->getId());

        $res = [];
        foreach ($categories as $cat) {
            array_push($res, $cat->getCategoryId());
        }

        // array_values return only values
        $res = array_values(array_unique($res));
        return $res;
    }

    private function getDateList(){
        $months = [];
        $res = [];

        $joinExpensesCategoriesModel = new JoinExpensesCategoriesModel();

        $expenses = $joinExpensesCategoriesModel->getAll($this->user->getId());

        foreach ($expenses as $expense) {
            array_push($months, substr($expense->getDate(),0, 7 ));
        }
        $months = array_values(array_unique($months));
        if(count($months) >3){
            array_push($res, array_pop($months));
            array_push($res, array_pop($months));
            array_push($res, array_pop($months));
        }
        return $res;
    }

    private function getCategoryList(){
        $res = [];

        $joinExpensesCategoriesModel = new JoinExpensesCategoriesModel();
        $expenses = $joinExpensesCategoriesModel->getAll($this->user->getId());

        foreach ($expenses as $expense) {
            array_push($res, $expense->getNameCategory());
        }
        $res = array_values(array_unique($res));

        return $res;
    }

    private function getCategoryColorList(){
        $res = [];

        $joinExpensesCategoriesModel = new JoinExpensesCategoriesModel();
        $expenses = $joinExpensesCategoriesModel->getAll($this->user->getId());

        foreach ($expenses as $expense) {
            array_push($res, $expense->getColor());
        }
        $res = array_unique($res);
        $res = array_values(array_unique($res));

        return $res;
    }

    

    function getHistoryJSON(){
        header('Content-Type: application/json');
        $res = [];
        $joinExpensesCategories = new JoinExpensesCategoriesModel();
        $expenses = $joinExpensesCategories->getAll($this->user->getId());

        foreach ($expenses as $expense) {
            array_push($res, $expense->toArray());
        }
        
        echo json_encode($res);

    }

    function getExpensesJSON(){
        header('Content-Type: application/json');

        $res = [];
        $categoryIds     = $this->getCategoryId();
        $categoryNames  = $this->getCategoryList();
        $categoryColors = $this->getCategoryColorList();

        array_unshift($categoryNames, 'month');
        array_unshift($categoryColors, 'categories');
        /* array_unshift($categoryNames, 'categories');
        array_unshift($categoryColors, null); */

        $months = $this->getDateList();

        for($i = 0; $i < count($months); $i++){
            $item = array($months[$i]);
            for($j = 0; $j < count($categoryIds); $j++){
                $total = $this->getTotalByMonthAndCategory( $months[$i], $categoryIds[$j]);
                array_push( $item, $total );
            }   
            array_push($res, $item);
        }

        array_unshift($res, $categoryNames);
        array_unshift($res, $categoryColors);
        
        echo json_encode($res);
    }

    private function getTotalByMonthAndCategory($date, $categoryId){
        $idUser = $this->user->getId();
        $joinExpensesCategoriesModel = new JoinExpensesCategoriesModel();

        $total = $joinExpensesCategoriesModel->getTotalByMonthAndCategory($date, $categoryId, $idUser);
        if($total == null) $total = 0;
        return $total;
    }

    function delete($params){
        
        if($params === null) $this->redirect('expenses', ['error' => ErrorMessages::ERROR_ADMIN_NEWCATEGORY_EXISTS]);
        $id = $params[0];
        $res = $this->model->delete($id);

        if($res){
            $this->redirect('expenses', ['success' => SuccessMessages::SUCCESS_EXPENSES_DELETE]);
        }else{
            $this->redirect('expenses', ['error' => ErrorMessages::ERROR_ADMIN_NEWCATEGORY_EXISTS]);
        }
    }

}