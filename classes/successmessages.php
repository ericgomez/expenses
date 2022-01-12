<?

class SuccessMessages
{
  const SUCCESS_ADMIN_NEWCATEGORY_EXISTS     = "f52228665c4f14c8695b194f670b0ef1";
  const SUCCESS_SIGNUP_NEWUSER       = "8281e04ed52ccfc13820d0f6acb0985a";
  const SUCCESS_EXPENSES_DELETE       = "fcd919285d5759328b143801573ec47d";
  const SUCCESS_EXPENSES_NEWEXPENSE   = "fbbd0f23184e820e1df466abe6102955";

  private $successList = [];

  public function __construct()
  {
    $this->successList = [
      SuccessMessages::SUCCESS_ADMIN_NEWCATEGORY_EXISTS => 'New category created successfully',
      SuccessMessages::SUCCESS_SIGNUP_NEWUSER => 'User registered successfully',
      SuccessMessages::SUCCESS_EXPENSES_DELETE => "Expense removed correctly",
      SuccessMessages::SUCCESS_EXPENSES_NEWEXPENSE => "New expense recorded correctly",
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
