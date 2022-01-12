<?

class Dashboard extends SessionController{

  function __construct(){
      parent::__construct();
      $this->user = $this->getUserSessionData();
  }

  function render(){
    $this->view->render('dashboard/index');
  }
}