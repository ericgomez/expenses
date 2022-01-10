<?

class View
{
  public function __construct()
  {
  }

  public function render($view, $data = [])
  {
    $this->data = $data;


    $this->handleMessages();

    // it is not required to validate if the file exists because 
    // the validation is done by the router (app)
    require 'views/' . $view . '.php';
  }

  private function handleMessages()
  {
    if (isset($_GET['success']) && isset($_GET['error'])) {
    } else if (isset($_GET['success'])) {
      // nothing is displayed because there cannot be an error and a success at the same time
      $this->handleSuccess();
    } else if (isset($_GET['error'])) {
      $this->handleError();
    }
  }

  private function handleError()
  {
    $hash = $_GET['error'];
    $errors = new ErrorMessages();

    if ($errors->existsKey($hash)) {
      $this->data['error'] = $errors->get($hash);
    } else {
      $this->data['error'] = NULL;
    }
  }


  private function handleSuccess()
  {
    if (isset($_GET['success'])) {
      $hash = $_GET['success'];
      $success = new SuccessMessages();

      if ($success->existsKey($hash)) {
        $this->data['success'] = $success->get($hash);
      } else {
        $this->data['success'] = NULL;
      }
    }
  }

  public function showMessages()
  {
    $this->showErrors();
    $this->showSuccess();
  }

  public function showErrors()
  {
    if (array_key_exists('error', $this->data)) {
      echo '<div class="error">' . $this->data['error'] . '</div>';
    }
  }

  public function showSuccess()
  {
    if (array_key_exists('success', $this->data)) {
      echo '<div class="success">' . $this->data['success'] . '</div>';
    }
  }
}
