<?

class ErrorMessages
{

  // ERROR_CONTROLLER_METHOD_ACTION
  const ERROR_ADMIN_NEWCATEGORY_EXISTS  = "1f8f0ae8963b16403c3ec9ebb851f156";
  const ERROR_SIGNUP_NEWUSER            = "1fdce6bbf47d6b26a9cd809ea1910222";
  const ERROR_SIGNUP_NEWUSER_EMPTY      = "a5bcd7089d83f45e17e989fbc86003ed";
  const ERROR_SIGNUP_NEWUSER_EXISTS            = "a74accfd26e06d012266810952678cf3";
  const ERROR_LOGIN_AUTHENTICATE               = "11c37cfab311fbe28652f4947a9523c4";
  const ERROR_LOGIN_AUTHENTICATE_EMPTY         = "2194ac064912be67fc164539dc435a42";
  const ERROR_LOGIN_AUTHENTICATE_DATA          = "bcbe63ed8464684af6945ad8a89f76f8";
  const ERROR_EXPENSES_DELETE                 = "8f48a0845b4f8704cb7e8b00d4981233";
  const ERROR_EXPENSES_NEWEXPENSE             = "8f48a0845b4f8704cb7e8b00d4981233";
  const ERROR_EXPENSES_NEWEXPENSE_EMPTY       = "a5bcd7089d83f45e17e989fbc86003ed";

  private $errorsList = [];

  public function __construct()
  {
    $this->errorsList = [
      ErrorMessages::ERROR_ADMIN_NEWCATEGORY_EXISTS  => 'Category name already exists, try another',
      ErrorMessages::ERROR_SIGNUP_NEWUSER            => 'There was an error trying to register. Try again',
      ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY      => 'Fields cannot be empty',
      ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS     => 'Username already exists, select another',
      ErrorMessages::ERROR_LOGIN_AUTHENTICATE        => 'There was a problem authenticating',
      ErrorMessages::ERROR_LOGIN_AUTHENTICATE_EMPTY  => 'Parameters to authenticate cannot be empty',
      ErrorMessages::ERROR_LOGIN_AUTHENTICATE_DATA   => 'Incorrect username and / or password',
      ErrorMessages::ERROR_EXPENSES_DELETE           => 'There was a problem eliminating the expense, try again',
      ErrorMessages::ERROR_EXPENSES_NEWEXPENSE       => 'There was a problem creating the expense, please try again',
      ErrorMessages::ERROR_EXPENSES_NEWEXPENSE_EMPTY => 'Fields cannot be empty',
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
