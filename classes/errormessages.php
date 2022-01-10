<?

class ErrorMessages
{

  // ERROR_CONTROLLER_METHOD_ACTION
  const ERROR_ADMIN_NEWCATEGORY_EXISTS = "1f8f0ae8963b16403c3ec9ebb851f156";

  private $errorsList = [];

  public function __construct()
  {
    $this->errorsList = [
      ErrorMessages::ERROR_ADMIN_NEWCATEGORY_EXISTS => 'El nombre de la categoría ya existe, intenta otra',

    ];
  }

  public function get($hash)
  {
    return $this->errorsList[$hash];
  }

  function existsKey($key)
  {
    if (array_key_exists($key, $this->errorsList)) {
      return true;
    } else {
      return false;
    }
  }
}
