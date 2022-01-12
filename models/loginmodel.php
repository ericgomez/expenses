<?

class LoginModel extends Model {
  private $username;
  private $password;

  public function __construct(){
    parent::__construct();
  }

  public function login($username, $password){
    $this->setUsername($username);
    $this->setPassword($password);

    try{
        $query = $this->prepare('SELECT * FROM users WHERE username = :username');
        $query->execute(['username' => $this->username]);
        
        // check if user exist
        if($query->rowCount() == 1){
            $item = $query->fetch(PDO::FETCH_ASSOC); 

            $user = new UserModel();
            $user->from($item);

            /* verifies that a password matches a hash 
               password_verify(string $password, string $hash) */
            if(password_verify($this->password, $user->getPassword())){
                // return user
                return $user;
            }else{
                return null;
            }
        }
    }catch(PDOException $e){
        return $e;
    }
  }

  public function setUsername($username){ $this->username = $username; }
  public function setPassword($password){ $this->password = $password; }

  public function getUsername(){ return $this->username; }
  public function getPassword(){ return $this->password; }

}
