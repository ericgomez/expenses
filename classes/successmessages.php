<?

class SuccessMessages
{
  const SUCCESS_ADMIN_NEWCATEGORY  = "f52228665c4f14c8695b194f670b0ef1";
  const SUCCESS_SIGNUP_NEWUSER            = "8281e04ed52ccfc13820d0f6acb0985a";
  const SUCCESS_EXPENSES_DELETE           = "fcd919285d5759328b143801573ec47d";
  const SUCCESS_EXPENSES_NEWEXPENSE       = "fbbd0f23184e820e1df466abe6102955";
  const SUCCESS_USER_UPDATEBUDGET         = "2ee085ac8828407f4908e4d134195e5c";
  const SUCCESS_USER_UPDATENAME           = "6fb34a5e4118fb823636ca24a1d21669";
  const SUCCESS_USER_UPDATEPASSWORD       = "6fb34a5e4118fb823636ca24a1d21669";
  const SUCCESS_USER_UPDATEPHOTO          = "edabc9e4581fee3f0056fff4685ee9a8";

  private $successList = [];

  public function __construct()
  {
    $this->successList = [
      SuccessMessages::SUCCESS_ADMIN_NEWCATEGORY => 'New category created successfully',
      SuccessMessages::SUCCESS_SIGNUP_NEWUSER => 'User registered successfully',
      SuccessMessages::SUCCESS_EXPENSES_DELETE => "Expense removed correctly",
      SuccessMessages::SUCCESS_EXPENSES_NEWEXPENSE => "New expense recorded correctly",
      SuccessMessages::SUCCESS_USER_UPDATEBUDGET => "Budget correctly updated",
      SuccessMessages::SUCCESS_USER_UPDATENAME => "Name successfully updated",
      SuccessMessages::SUCCESS_USER_UPDATEPASSWORD => "Password updated successfully",
      SuccessMessages::SUCCESS_USER_UPDATEPHOTO => "User Image Updated Successfully",
      
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
