<?

class SuccessMessages
{
  const SUCCESS_ADMIN_NEWCATEGORY_EXISTS     = "f52228665c4f14c8695b194f670b0ef1";

  private $successList = [];

  public function __construct()
  {
    $this->successList = [
      SuccessMessages::SUCCESS_ADMIN_NEWCATEGORY_EXISTS => "Nueva categoría creada correctamente",
    ];
  }

  public function get($hash)
  {
    return $this->successList[$hash];
  }

  public function existsKey($key)
  {
    if (array_key_exists($key, $this->successList)) {
      return true;
    } else {
      return false;
    }
  }
}
