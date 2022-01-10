<?

class Controller
{
  public function __construct()
  {
    $this->view = new View();
  }

  // charger the model
  function loadModel($model)
  {
    $url = 'models/' . $model . '.php';

    // verifier if the file exists
    if (file_exists($url)) {
      require_once $url;

      $objectModel = $model . 'Model';
      $this->model = new $objectModel();
    }
  }
}
