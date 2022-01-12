<?

class UserModel extends Model implements IModel
{

  private $id;
  private $username;
  private $password;
  private $role;
  private $budget;
  private $photo;
  private $name;

  public function __construct()
  {
    parent::__construct();
    $this->username = '';
    $this->password = '';
    $this->role = '';
    $this->budget = 0.0;
    $this->photo = '';
    $this->name = '';
  }

  public function save()
  {
    try {
      $query = $this->prepare('INSERT INTO users (username, password, role, budget, photo, name) VALUES (:username, :password, :role, :budget, :photo, :name)');
      $query->execute([
        'username' => $this->username,
        'password' => $this->password,
        'role'    => $this->role,
        'budget' => $this->budget,
        'photo' => $this->photo,
        'name' => $this->name
      ]);

      return true;
    } catch (PDOException $e) {
      return false;
    }
  }

  public function getAll() {
    $items = [];
    try {
      $query = $this->query('SELECT * FROM users');

      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

        $this->setId($row['id']);
        $this->setUsername($row['username']);
        $this->setPassword($row['password']);
        $this->setRole($row['role']);
        $this->setBudget($row['budget']);
        $this->setPhoto($row['photo']);
        $this->setName($row['name']);

        array_push($items, $this);
      }

      return $items;
    } catch (PDOException $e) {}
  }

  public function getById($id) {
    $this->setId($id);

    try {
      $query = $this->prepare('SELECT * FROM users WHERE id = :id');
      $query->execute([
        'id' => $this->id
      ]);

      $user = $query->fetch(PDO::FETCH_ASSOC);

      $this->setId($user['id']);
      $this->setUsername($user['username']);
      $this->setPassword($user['password']);
      $this->setRole($user['role']);
      $this->setBudget($user['budget']);
      $this->setPhoto($user['photo']);
      $this->setName($user['name']);

      return $this;
    } catch (PDOException $e) {}
  }

  public function delete($id) {
    $this->setId($id);
    
    try {
      $query = $this->prepare('DELETE FROM users WHERE id = :id');
      $query->execute([
        'id' => $this->id
      ]);

      return true;
    } catch (PDOException $e) {
      return false;
    }
  }

  public function update() {
    try {
      $query = $this->prepare('UPDATE users SET username = :username, password = :password, role = :role, budget = :budget, photo = :photo, name = :name WHERE id = :id');
      $query->execute([
        'id' => $this->id,
        'username' => $this->username,
        'password' => $this->password,
        'role'    => $this->role,
        'budget' => -$this->budget,
        'photo' => $this->photo,
        'name' => $this->name
      ]);

      return true;
    } catch (PDOException $e) {
      return false;
    }
  }

  public function from($array) {
    $this->id       = $array['id'];
    $this->username = $array['username'];
    $this->password = $array['password'];
    $this->role     = $array['role'];
    $this->budget   = $array['budget'];
    $this->photo    = $array['photo'];
    $this->name     = $array['name'];
  }

  // check if user exists
  public function exists($username) {
    try {
      $query = $this->prepare('SELECT username FROM users WHERE username = :username');
      $query->execute([
        'username' => $username
      ]);

      if ($query->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      return false;
    }
  }

  public function comparePassword($password, $id) {
    try {
      $user = $this->getById($id);

      return password_verify($password, $user->getPassword());
    } catch (PDOException $e) {
      return false;
    }
  }

  private function getHashedPassword($password)
  {
    return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
  }

  // Getters and setters

  public function setId($id) {             $this->id = $id; }
  public function setUsername($username) { $this->username = $username; }
  public function setRole($role) {         $this->role = $role; }
  public function setBudget($budget) {     $this->budget = $budget; }
  public function setPhoto($photo) {       $this->photo = $photo; }
  public function setName($name) {         $this->name = $name; }
  public function setPassword($password) { 
    $this->password = $this->getHashedPassword($password); 
  }


  public function getId() {         return $this->id; }
  public function getUsername() {   return $this->username; }
  public function getPassword() {   return $this->password; }
  public function getRole() {       return $this->role; }
  public function getBudget() {     return $this->budget; }
  public function getPhoto() {      return $this->photo; }
  public function getName() {       return $this->name; }


}