<?

class Signup extends SessionController
{

  function __construct(){
    parent::__construct();
  }

  function render(){
    $this->view->render('login/signup', []);
  }

  function newUser(){
    if ($this->existPOST(['username', 'password'])) { // check if exist

      $username = $this->getPost('username');
      $password = $this->getPost('password');

      //validate data
      if ($username == '' || empty($username) || $password == '' || empty($password)) {
        // redirect required [view , message]
        $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY]);
      }

      $user = new UserModel();
      $user->setUsername($username);
      $user->setPassword($password);
      $user->setRole("user");

      if ($user->exists($username)) {
        // redirect required [view , message]
        $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS]);
      } else if ($user->save()) {
        // redirect required [view , message]
        $this->redirect('', ['success' => SuccessMessages::SUCCESS_SIGNUP_NEWUSER]);
      } else {
        // redirect required [view , message]
        $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER]);
      }
    } else {
      // redirect required [view , message]
      $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER]);
    }
  }
}
