<?

class ErrorMessages
{

  // ERROR_CONTROLLER_METHOD_ACTION
  const ERROR_ADMIN_NEWCATEGORY_EXISTS          = "1f8f0ae8963b16403c3ec9ebb851f156";
  const ERROR_SIGNUP_NEWUSER                    = "1fdce6bbf47d6b26a9cd809ea1910222";
  const ERROR_SIGNUP_NEWUSER_EMPTY              = "a5bcd7089d83f45e17e989fbc86003ed";
  const ERROR_SIGNUP_NEWUSER_EXISTS             = "a74accfd26e06d012266810952678cf3";
  const ERROR_LOGIN_AUTHENTICATE                = "11c37cfab311fbe28652f4947a9523c4";
  const ERROR_LOGIN_AUTHENTICATE_EMPTY          = "2194ac064912be67fc164539dc435a42";
  const ERROR_LOGIN_AUTHENTICATE_DATA           = "bcbe63ed8464684af6945ad8a89f76f8";
  const ERROR_EXPENSES_DELETE                   = "8f48a0845b4f8704cb7e8b00d4981233";
  const ERROR_EXPENSES_NEWEXPENSE               = "8f48a0845b4f8704cb7e8b00d4981233";
  const ERROR_EXPENSES_NEWEXPENSE_EMPTY         = "a5bcd7089d83f45e17e989fbc86003ed";
  const ERROR_USER_UPDATEBUDGET                 = "e99ab11bbeec9f63fb16f46133de85ec";
  const ERROR_USER_UPDATEBUDGET_EMPTY           = "807f75bf7acec5aa86993423b6841407";
  const ERROR_USER_UPDATENAME_EMPTY             = "0f0735f8603324a7bca482debdf088fa";
  const ERROR_USER_UPDATENAME                   = "98217b0c263b136bf14925994ca7a0aa";
  const ERROR_USER_UPDATEPASSWORD               = "365009a3644ef5d3cf7a229a09b4d690";
  const ERROR_USER_UPDATEPASSWORD_EMPTY         = "0f0735f8603324a7bca482debdf088fa";
  const ERROR_USER_UPDATEPASSWORD_ISNOTTHESAME  = "27731b37e286a3c6429a1b8e44ef3ff6";
  const ERROR_USER_UPDATEPHOTO                  = "dfb4dc6544b0dae81ea132de667b2a5d";
  const ERROR_USER_UPDATEPHOTO_FORMAT           = "53f3554f0533aa9f20fbf46bd5328430";

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
      ErrorMessages::ERROR_USER_UPDATEBUDGET         => 'Budget cannot be updated',
      ErrorMessages::ERROR_USER_UPDATEBUDGET_EMPTY   => 'The budget cannot be empty or negative',
      ErrorMessages::ERROR_USER_UPDATENAME_EMPTY     => 'The name cannot be empty or negative',
      ErrorMessages::ERROR_USER_UPDATENAME           => 'Name cannot be updated',
      ErrorMessages::ERROR_USER_UPDATEPASSWORD       => 'Unable to update password',
      ErrorMessages::ERROR_USER_UPDATEPASSWORD_EMPTY => 'The name cannot be empty or negative',
      ErrorMessages::ERROR_USER_UPDATEPASSWORD_ISNOTTHESAME => 'The passwords are not the same',
      ErrorMessages::ERROR_USER_UPDATEPHOTO          => 'There was an error updating the photo',
      ErrorMessages::ERROR_USER_UPDATEPHOTO_FORMAT   => 'The file is not an image',
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
