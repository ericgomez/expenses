<?php

class User extends SessionController{

    private $user;

    function __construct(){
        parent::__construct();

        $this->user = $this->getUserSessionData();
    }

    function render(){
        $this->view->render('user/index', [
            "user" => $this->user
        ]);
    }

    function updateBudget(){
        if(!$this->existPOST(['budget'])){
            $this->redirect('user', ['error' => ErrorMessages::ERROR_USER_UPDATEBUDGET]);
            return;
        }

        $budget = $this->getPost('budget');

        if(empty($budget) || $budget === 0 || $budget < 0){
            $this->redirect('user', ['error' => ErrorMessages::ERROR_USER_UPDATEBUDGET_EMPTY]);
            return;
        }
    
        $this->user->setBudget($budget);
        if($this->user->update()){
            $this->redirect('user', ['success' => SuccessMessages::SUCCESS_USER_UPDATEBUDGET]);
        }else{
            //error
        }
    }

    function updateName(){
        if(!$this->existPOST(['name'])){
            $this->redirect('user', ['error' => ErrorMessages::ERROR_USER_UPDATEBUDGET]);
            return;
        }

        $name = $this->getPost('name');

        if(empty($name)){
            $this->redirect('user', ['error' => ErrorMessages::ERROR_USER_UPDATEBUDGET]);
            return;
        }
        
        $this->user->setName($name);
        if($this->user->update()){
            $this->redirect('user', ['success' => SuccessMessages::SUCCESS_USER_UPDATEBUDGET]);
        }else{
            //error
        }
    }

    function updatePassword(){
        if(!$this->existPOST(['current_password', 'new_password'])){
            $this->redirect('user', ['error' => ErrorMessages::ERROR_USER_UPDATEPASSWORD]);
            return;
        }

        $current = $this->getPost('current_password');
        $new     = $this->getPost('new_password');

        if(empty($current) || empty($new)){
            $this->redirect('user', ['error' => ErrorMessages::ERROR_USER_UPDATEPASSWORD_EMPTY]);
            return;
        }

        if($current === $new){
            $this->redirect('user', ['error' => ErrorMessages::ERROR_USER_UPDATEPASSWORD_ISNOTTHESAME]);
            return;
        }

        $newHash = $this->model->comparePasswords($current, $this->user->getId());
        if($newHash != null){
            $this->user->setPassword($new, true);
            
            if($this->user->update()){
                $this->redirect('user', ['success' => SuccessMessages::SUCCESS_USER_UPDATEPASSWORD]);
            }else{
                //error
                $this->redirect('user', ['error' => ErrorMessages::ERROR_USER_UPDATEPASSWORD]);
            }
        }else{
            $this->redirect('user', ['error' => ErrorMessages::ERROR_USER_UPDATEPASSWORD]);
            return;
        }
    }

    function updatePhoto(){
        if(!isset($_FILES['photo'])){
            $this->redirect('user', ['error' => ErrorMessages::ERROR_USER_UPDATEPHOTO]);
            return;
        }
        $photo = $_FILES['photo'];

        $target_dir = "public/img/photos/";
        $extArray = explode('.',$photo["name"]);
        $filename = $extArray[sizeof($extArray)-2];
        $ext = $extArray[sizeof($extArray)-1];
        $hash = md5(Date('Ymdgi') . $filename) . '.' . $ext;
        $target_file = $target_dir . $hash;

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        $check = getimagesize($photo["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            //echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            //echo "Sorry, your file was not uploaded.";
            $this->redirect('user', ['error' => ErrorMessages::ERROR_USER_UPDATEPHOTO_FORMAT]);
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($photo["tmp_name"], $target_file)) {
                $this->user->setPhoto($hash);
                $this->user->update();
                
                $this->redirect('user', ['success' => SuccessMessages::SUCCESS_USER_UPDATEPHOTO]);
                return;
              } else {
                $this->redirect('user', ['error' => ErrorMessages::ERROR_USER_UPDATEPHOTO]);
            }
        }
        
    }
}