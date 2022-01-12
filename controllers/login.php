<?
class Login extends SessionController
{

  public function __construct(){
    parent::__construct();
  }

  public function render(){
    $this->view->render('login/index');
  }

  function authenticate(){
    if ($this->existPOST(['username', 'password'])) {
      $username = $this->getPost('username');
      $password = $this->getPost('password');

      //validate data
      if ($username == '' || empty($username) || $password == '' || empty($password)) {
        $this->redirect('', ['error' => ErrorMessages::ERROR_LOGIN_AUTHENTICATE_EMPTY]);
        return;
      }

      $user = $this->model->login($username, $password);

      if ($user != null) {
        $this->initialize($user);
      } else {
        $this->redirect('', ['error' => ErrorMessages::ERROR_LOGIN_AUTHENTICATE_DATA]);
        return;
      }
    } else {
      $this->redirect('', ['error' => ErrorMessages::ERROR_LOGIN_AUTHENTICATE]);
    }
  }

}
