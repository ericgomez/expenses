<?

class View
{
  public function __construct()
  {
  }

  public function render($view, $data = [])
  {
    $this->data = $data;
    // it is not required to validate if the file exists because 
    // the validation is done by the router (app)
    require 'views/' . $view . '.php';
  }
}
