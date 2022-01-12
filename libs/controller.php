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
    $url = 'models/' . $model . 'model.php';

    // verifier if the file exists
    if (file_exists($url)) {
      require_once $url;

      $objectModel = $model . 'Model';
      $this->model = new $objectModel();
    }
  }

  public function existPOST($params)
  {
    foreach ($params as $param) {
      if(!isset($_POST[$param])){
        return false;
      }
    }

    return true;
  }

  public function existGET($params)
  {
    foreach ($params as $param) {
      if (!isset($_GET[$param])) {
        return false;
      }
    }

    return true;
  }

  // change method get and post
  public function getGet($name)
  {
    return $_GET[$name];
  }

  // change method get and post
  public function getPost($name)
  {
    return $_POST[$name];
  }

  public function redirect($url, $messages)
  {
    $data = [];
    $params = '';

    foreach ($messages as $key => $message) {
      array_push($data, $key . '=' . $message);
    }

    $param = join('&', $data);

    if ($param != '') {
      $params = '?' . $param;
    }

    header('Location: ' . constant('URL') . '/' . $url . $params);
  }
}
