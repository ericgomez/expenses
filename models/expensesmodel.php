<?

class ExpensesModel extends Model implements IModel{

    private $id;
    private $title;
    private $amount;
    private $categoryId;
    private $date;
    private $userId;

    public function __construct(){
      parent::__construct();
  }


    public function setId($id){ $this->id = $id; }
    public function setTitle($title){ $this->title = $title; }
    public function setAmount($amount){ $this->amount = $amount; }
    public function setCategoryId($categoryId){ $this->categoryId = $categoryId; }
    public function setDate($date){ $this->date = $date; }
    public function setUserId($userId){ $this->userId = $userId; }

    public function getId(){ return $this->id;}
    public function getTitle(){ return $this->title; }
    public function getAmount(){ return $this->amount; }
    public function getCategoryId(){ return $this->categoryId; }
    public function getDate(){ return $this->date; }
    public function getUserId(){ return $this->userId; }

    public function save(){
        try{
            $query = $this->prepare('INSERT INTO expenses (title, amount, category_id, date, id_user) VALUES(:title, :amount, :category, :d, :user)');
            $query->execute([
                'title'    => $this->title, 
                'amount'   => $this->amount, 
                'category' => $this->categoryId, 
                'user'     => $this->userId, 
                'd'        => $this->date
            ]);

            if($query->rowCount()) return true;

            return false;
        }catch(PDOException $e){
            return false;
        }
    }

    public function getAll(){
        $items = [];

        try{
            $query = $this->query('SELECT * FROM expenses');

            while($response = $query->fetch(PDO::FETCH_ASSOC)){

                // $item = new ExpensesModel();
                $this->from($response); 
                
                array_push($items, $this);
            }

            return $items;

        }catch(PDOException $e){
            echo $e;
        }
    }
    
    public function getById($id){
        try{
            $query = $this->prepare('SELECT * FROM expenses WHERE id = :id');
            $query->execute([ 'id' => $id]);

            $expense = $query->fetch(PDO::FETCH_ASSOC);

            $this->from($expense);

            return $this;
        }catch(PDOException $e){
            return false;
        }
    }

    public function update(){
      try{
          $query = $this->prepare('UPDATE expenses SET title = :title, amount = :amount, category_id = :category, date = :d, id_user = :user WHERE id = :id');
          $query->execute([
              'title' => $this->title, 
              'amount' => $this->amount, 
              'category' => $this->categoryId, 
              'user' => $this->userId, 
              'd' => $this->date
          ]);
          return true;
      }catch(PDOException $e){
          echo $e;
          return false;
      }
  }

  public function delete($id){
    try{
        $query = $this->prepare('DELETE FROM expenses WHERE id = :id');
        $query->execute([ 'id' => $id]);
        return true;
    }catch(PDOException $e){
        echo $e;
        return false;
    }
}

  public function from($array){
      $this->id = $array['id'];
      $this->title = $array['title'];
      $this->amount = $array['amount'];
      $this->categoryId = $array['category_id'];
      $this->date = $array['date'];
      $this->userId = $array['id_user'];
  }

    public function getAllByUserId($userId){
        $items = [];

        try{
            $query = $this->prepare('SELECT * FROM expenses WHERE id_user = :userId');
            $query->execute([ "userId" => $userId]);

            while($response = $query->fetch(PDO::FETCH_ASSOC)){
                // $item = new ExpensesModel();
                // $item->from($p); 
                $this->from($response); 
                
                array_push($items, $this);
            }

            return $items;

        }catch(PDOException $e){
            return [];
            // echo $e;
        }
    }

    public function getByUserIdAndLimit($userId, $n){
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM expenses WHERE id_user = :userId ORDER BY expenses.date DESC LIMIT 0, :n ');
            $query->execute([ 'n' => $n, 'userId' => $userId]);
            while($response = $query->fetch(PDO::FETCH_ASSOC)){
                // $item = new ExpensesModel();
                // $item->from($p); 

                $this->from($response); 
                
                array_push($items, $this);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }


    function getTotalAmountThisMonth($idUser){
        try{
            $year = date('Y');
            $month = date('m');
            $query = $this->db->connect()->prepare('SELECT SUM(amount) AS total FROM expenses WHERE YEAR(date) = :year AND MONTH(date) = :month AND id_user = :idUser');
            $query->execute(['year' => $year, 'month' => $month, 'idUser' => $idUser]);

            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total == null) $total = 0;
            
            return $total;

        }catch(PDOException $e){
            return null;
        }
    }


    function getMaxExpensesThisMonth($idUser){
        try{
            $year = date('Y');
            $month = date('m');
            $query = $this->db->connect()->prepare('SELECT MAX(amount) AS total FROM expenses WHERE YEAR(date) = :year AND MONTH(date) = :month AND id_user = :idUser');
            $query->execute(['year' => $year, 'month' => $month, 'idUser' => $idUser]);

            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total == null) $total = 0;
            
            return $total;

        }catch(PDOException $e){
            return null;
        }
    }


    function getTotalByCategoryThisMonth($categoryId, $userId){
        try{
            $total = 0;
            $year = date('Y');
            $month = date('m');
            $query = $this->prepare('SELECT SUM(amount) AS total from expenses WHERE category_id = :categoryId AND id_user = :userId AND YEAR(date) = :year AND MONTH(date) = :month');
            $query->execute(['categoryId' => $categoryId, 'userId' => $userId, 'year' => $year, 'month' => $month]);
            
            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total == null) return 0;
            return $total;

        }catch(PDOException $e){
            return null;
        }
    }


    function getNumberOfExpensesByCategoryThisMonth($categoryId, $userId){
        try{
            $total = 0;
            $year = date('Y');
            $month = date('m');
            $query = $this->prepare('SELECT COUNT(id) AS total from expenses WHERE category_id = :categoryId AND id_user = :userId AND YEAR(date) = :year AND MONTH(date) = :month');
            $query->execute(['categoryId' => $categoryId, 'userId' => $userId, 'year' => $year, 'month' => $month]);

            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total == null) return 0;
            return $total;

        }catch(PDOException $e){
            return null;
        }
    }
}


