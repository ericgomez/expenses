<?

require_once('classes/session.php');

class SessionController extends Controller {
  private $userSession;
  private $username;
  private $userId;

  private $session;
  private $sites;

  private $user;

  public function __construct() {
    parent::__construct();
    $this->init();
  }

  public function init() {
    $this->session = new Session();

    $json = $this->getJSONFileConfig();

    $this->sites = $json['sites'];
    $this->defaultSites = $json['defaultSites'];

    $this->validateSession();
  }

  private function getJSONFileConfig() {
    $string = file_get_contents('config/access.json');
    // $string = file_get_contents(__DIR__ . '/../config/access.json');
    $json = json_decode($string, true);

    return $json;
  }

  public function validateSession() {
    // check if session exists
    if ($this->existsSession()) {
      $role = $this->getUserSessionData()->getRole();

      // if page is public
      if ($this->isPublic()) {
        $this->redirectDefaultSiteByRole($role);
      } else {
        if($this->isAuthorized($role)){
          // access granted
        }else{
            $this->redirectDefaultSiteByRole($role);
        }
      }
    } else {
      // not exists session
      if($this->isPublic()){
        // access granted
      }else{
          header('Location: '. constant('URL') . '');
      }
    }
  }

  public function existsSession() {
    if (!$this->session->exists()) return false;
    if ($this->session->getCurrentUser() == null) return false;
    
    $userId = $this->session->getCurrentUser();

    if ($userId) return true;

    return false;
  }

  public function getUserSessionData() {
    $id = $this->session->getCurrentUser();

    $this->user = new UserModel();
    $this->user->getById($id);

    return $this->user;
  }

  public function initialize($user){
    $this->session->setCurrentUser($user->getId());
    $this->authorizeAccess($user->getRole());
}

  public function isPublic() {
    $currentURL = $this->getCurrentPage();
    $currentURL = preg_replace("/\?.*/", "", $currentURL);

    for ($i=0; $i < sizeof($this->sites); $i++) { 
      if ($this->sites[$i]['site'] === $currentURL && $this->sites[$i]['access'] === 'public') {
        return true;
      }
    }
    return false;
  }

  public function getCurrentPage() {
    $actualLink = trim($_SERVER['REQUEST_URI']);
    $url = explode('/', $actualLink);

    return $url[2];
  }

  private function redirectDefaultSiteByRole($role) {
    $url = '';

    for ($i=0; $i < sizeof($this->sites); $i++) { 
      if ($this->sites[$i]['role'] === $role) {
        $url = '/system/'. $this->sites[$i]['site'];
        break;
      }
    }
    // header('Location: '. constant('URL') . $url);
    header('Location: '. $url);
  }

  private function isAuthorized($role){
    $currentURL = $this->getCurrentPage();
    $currentURL = preg_replace( "/\?.*/", "", $currentURL);
    
    for($i = 0; $i < sizeof($this->sites); $i++){
        if($this->sites[$i]['site'] === $currentURL  && $this->sites[$i]['role'] === $role){
            return true;
        }
    }
    return false;
  }

  public function authorizeAccess($role){
    switch($role){
        case 'user':
            $this->redirect($this->defaultSites['user'], []);
        break;
        case 'admin':
            $this->redirect($this->defaultSites['admin'], []);
        break;
        default:
    }
  }

  function logout(){
      $this->session->closeSession();
  }
}