<?

require_once './controllers/errors.php';

class App
{
  public function __construct()
  {
    $url = isset($_GET['url']) ? $_GET['url'] : null;
    $url = rtrim($url, '/');
    // Split a string by a string
    $url = explode('/', $url);

    if (empty($url[0])) {
      // If the first element is empty, then we are at the main page
      $fileController = 'controllers/login.php';
      require_once $fileController;
      $controller = new Login(); // Load the controller
      $controller->loadModel('login'); // Load model
      $controller->render(); // Render view
      return false;
    }

    $fileController = 'controllers/' . $url[0] . '.php';
    if (file_exists($fileController)) {
      require_once $fileController;
      // Load the controller
      $controller = new $url[0]; // Load the controller
      $controller->loadModel($url[0]); // Load model

      // Load the (action) method
      if (isset($url[1])) {
        if (method_exists($controller, $url[1])) {
          if (isset($url[2])) {
            // Load the second parameter
            $numParams = count($url) - 2;
            // array of parameters
            $params = [];

            for ($i = 0; $i < $numParams; $i++) {
              array_push($params, $url[$i + 2]);
            }

            $controller->{$url[1]}($params);
          } else {
            // Load the (action) method existed in the controller
            $controller->{$url[1]}();
          }
        } else {
          // return error in case of not existing (action) method

          $controller = new Errors();
          $controller->render();
        }
      } else {
        // return (action) method by default
        $controller->render();
      }
    } else {
      // if not exist file controller , return error 404
      // throw new Exception("Method $url[1] not found in the controller $url[0]");
      $controller = new Errors();
      $controller->render();
    }
  }
}
