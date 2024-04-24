<?php
require_once (Settings::PATH['models'].'/user.model.php');
require_once (Settings::PATH['models'].'/authorization.model.php');
// require_once (Settings::PATH['models'].'/typeUser.model.php');

class UserController {
    
    private $userModel;
    
    public function __CONSTRUCT() {
        $this->userModel = new User();
        $this->authModel = new Authorization();
        // $this->typeUserModel = new TypeUser();
    }
    
    //ADMIN SITE
    public function index() {
        $users = $this->getAll();
        // $typeUsers = $this->typeUserModel->getAll();
        require_once (Settings::PATH['view'].'/user/user.php');
    }

    public function getAll() {
        return $this->userModel->getAll();
    }
    
    public function edit() {
        $user = new UserEntity();
        
        if(isset($_REQUEST['id'])) {
            $user = $this->userModel->getOne($_REQUEST['id']);
        }
        require_once (Settings::PATH['view'].'/user/userForm.php');
    }

    public function create() {
        $user = new UserEntity();

        require_once (Settings::PATH['view'].'/user/userForm.php');
    }
    
    public function save() {
        $user = new UserEntity();
        $auth = new AuthorizationEntity();

        $user->setId($_REQUEST['id']);
        $user->setName($_REQUEST['name']);
        $user->setSurname($_REQUEST['surname']);      
        $user->setEmail($_REQUEST['email']);
        $user->setTelephone($_REQUEST['telephone']);
        $user->setAddress($_REQUEST['address']);
        $user->setIdType($_REQUEST['idType']);
        
        if ($user->getId() > 0) {
            $this->userModel->update($user);  
        } else {
            $this->userModel->insert($user);  
            
            $auth->setUsername($_REQUEST['username']);
            $auth->setPassword($_REQUEST['password']);
            $auth->setUserId((int) $this->userModel->getLastUserId());
            //$this->authModel->insert($auth);
        }


        header('Location: '.Settings::PATH['base'].'/user');
    }
    
    public function delete() {
        $this->userModel->delete($_REQUEST['id']);
        header('Location: '.Settings::PATH['base'].'/user');
    }

}