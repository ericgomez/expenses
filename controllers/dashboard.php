<?

class Dashboard extends SessionController{

  public function __construct(){
      parent::__construct();
      $this->user = $this->getUserSessionData();
  }

  public function render(){
    $this->view->render('dashboard/index');
  }

  
}