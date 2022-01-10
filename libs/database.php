<?

class Database
{
  private $db_host;
  private $db_user;
  private $db_pass;
  private $db_name;
  private $db_charset;

  public function __construct()
  {
    $this->db_host = constant('DB_HOST');
    $this->db_user = constant('DB_USER');
    $this->db_pass = constant('DB_PASS');
    $this->db_name = constant('DB_NAME');
    $this->db_charset = constant('DB_CHARSET');
  }

  function connect()
  {
    try {
      $connection = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name . ';charset=' . $this->db_charset;
      $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
      );

      $pdo = new PDO($connection, $this->db_user, $this->db_pass, $options);

      return $pdo;
    } catch (PDOException $e) {
      throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
  }
}
