<?

class Login extends SessionController
{

  public function __construct()
  {
    parent::__construct();
  }

  public function render()
  {
    $this->view->render('login/index');
  }
}
