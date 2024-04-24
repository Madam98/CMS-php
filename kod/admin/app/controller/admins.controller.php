<?php

require_once(Settings::PATH['models'].'/post.model.php');
require_once(Settings::PATH['models'].'/category.model.php');
require_once(Settings::PATH['models'].'/authorization.model.php');
require_once(Settings::PATH['models'].'/user.model.php');

class AdminsController {
    
    public function __construct() {
        
    }
    
    public function index() {


        //require_once (Settings::PATH['view'].'/layouts/navbars.php');
        //require_once (Settings::PATH['view'].'/admin/showadmins.php');

    }

    public function showadmins(){
        
        $userModel = new User();
        $authorization = new Authorization();
        $admins = $userModel->getAdmins();

        // echo '<pre>';
        // var_dump($admins);
        // echo '</pre>';
        // die();
        $infobox = "Demote";
        $linkinfo = Settings::PATH['base'].'/admins/demote/';
        $info = "Demote to User";
        $info2 = "Delete Admin";
        $info3 = "Create Admin";
        require_once (Settings::PATH['view'].'/layouts/navbars.php');
        require_once (Settings::PATH['view'].'/admin/showadmins.php');
    }

    public function showusers(){
        
        $userModel = new User();
        $authorization = new Authorization();
        $admins = $userModel->getUsers();

        $infobox = "Upgrade";
        $linkinfo = Settings::PATH['base'].'/admins/upgrade/';
        $info = "Update to Admin";
        $info2 = "Delete User";
        $info3 = "Create User";
        require_once (Settings::PATH['view'].'/layouts/navbars.php');
        require_once (Settings::PATH['view'].'/admin/showadmins.php');
    }


    public function demote() {
        $userModel = new User();        
        $count = $userModel->countAllAdmins();
        if ($count < 2){
            $infoboxVisible = true;
            $_SESSION['infoboxVisible'] = $infoboxVisible;

            header('Location: '.Settings::PATH['base'].'/admins/showadmins');
        }
        else{
            $user = $userModel->getOne($_REQUEST['id']);
            $user->setIdType(2);

            $userModel->update($user);

            header('Location: '.Settings::PATH['base'].'/admins/showadmins');
        }
    }

    public function upgrade() {
        $userModel = new User();      
        $user = $userModel->getOne($_REQUEST['id']);
        $user->setIdType(1);
        $userModel->update($user);

        header('Location: '.Settings::PATH['base'].'/admins/showusers');
    }


    public function delete() {
        $userModel = new User();       
        $count = $userModel->countAllAdmins();
        $status = $userModel->getStatus($_REQUEST['id']);
        if ($count < 2 && $status != 2){
            $infoboxVisible = true;
            $_SESSION['infoboxVisible'] = $infoboxVisible;

            header('Location: '.Settings::PATH['base'].'/admins/showadmins');
        }
        else if ($status == 2) {
            $userModel->delete($_REQUEST['id']);
            header('Location: '.Settings::PATH['base'].'/admins/showadmins');
        }
        
        require_once (Settings::PATH['view'].'/layouts/navbars.php');
        require_once (Settings::PATH['view'].'/admin/showadmins.php');
    }


    

    public function create() {
        require_once (Settings::PATH['view'].'/layouts/navbars.php');
        require_once (Settings::PATH['view'].'/admin/create.php');
    }


    public function save() {
        $user          = new UserEntity();
        $userModel     = new User();
        $authorization = new AuthorizationEntity();
        $authorizationModel = new Authorization();
        //1
        $user->setName($_REQUEST['name']);
        if ($user->getName() == ""){
            $error['NAME_CAN_NOT_BE_EMPTY!'] = Settings::ERRORS['NAME_CAN_NOT_BE_EMPTY!'];
        }

        //2
        $user->setSurname($_REQUEST['surname']); 
        if ($user->getSurname() == ""){
            $error['SURNAME_CAN_NOT_BE_EMPTY!'] = Settings::ERRORS['SURNAME_CAN_NOT_BE_EMPTY!'];
        }
        
        //3
        $user->setEmail($_REQUEST['email']);
        if ($user->getEmail() == ""){
            $error['EMAIL_CAN_NOT_BE_EMPTY!'] = Settings::ERRORS['EMAIL_CAN_NOT_BE_EMPTY!'];
        }

        if ($userModel->userExistsByEmail($user->getEmail()) ){
            $error['USER_WITH_THIS_EMAIL_EXISTS!'] = Settings::ERRORS['USER_WITH_THIS_EMAIL_EXISTS!'];
        }


        //4
        if ($user->getTelephone() == ""){
            $user->setTelephone($_REQUEST['telephone']);
        } else {
            $user->setTelephone(NULL);
        }
        
        //5
        if ($user->getAddress() == ""){
            $user->setAddress($_REQUEST['address']);
        } else {
            $user->setAddress(NULL);
        }
        
        //6
        $user->setIdType(1);
        

            //7
            $authorization->setUsername($_REQUEST['username']);
            if ($authorization->getUsername() == "" ){
                $error['USERNAME_CAN_NOT_BE_EMPTY!'] = Settings::ERRORS['USERNAME_CAN_NOT_BE_EMPTY!'];
            }

            if ($authorizationModel->getByUsername($_REQUEST['username']) ){
                $error['USER_WITH_THIS_USERNAME_EXISTS!'] = Settings::ERRORS['USER_WITH_THIS_USERNAME_EXISTS!'];
            }
            //8
            $authorization->setPassword($_REQUEST['password']);
            if ($authorization->getPassword() == ""){
                $error['PASSWORD_CAN_NOT_BE_EMPTY!'] = Settings::ERRORS['PASSWORD_CAN_NOT_BE_EMPTY!'];
            }

            // Sprawdzanie poprawności hasła
            $password = $authorization->getPassword();
            if (!$this->validatePassword($password)) {
                $error['INVALID_PASSWORD!'] = Settings::ERRORS['INVALID_PASSWORD!']; 
            }


            if ($error != null) {      
                
                $_SESSION['form_values'] = $_POST;    
                $_SESSION['error'] = $error;
                header('Location: '.Settings::PATH['base'].'/admins/create');
            }
            else{
                //INSERT
                $userModel->insert($user);  
                $authorization->setUserId((int) $userModel->getLastUserId());
                $authorizationModel->insert($authorization);
                header('Location: '.Settings::PATH['base'].'/admins/showadmins');
            }
        
    }

    private function validatePassword($password) {
        // Sprawdzanie długości hasła
        if (strlen($password) < 12) {
            return false;
        }
    
        // Sprawdzanie obecności co najmniej jednej wielkiej litery
        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }
    
        // Sprawdzanie obecności co najmniej jednej małej litery
        if (!preg_match('/[a-z]/', $password)) {
            return false;
        }
    
        // Sprawdzanie obecności co najmniej dwóch cyfr
        if (preg_match_all('/\d/', $password) < 2) {
            return false;
        }
    
        // Sprawdzanie obecności znaków specjalnych
        if (preg_match('[!@#$%^&*()-_=+{}[\]|;:,.<>?~]', $password)) {
            return false;
        }
    
        // Sprawdzanie, czy hasło zawiera znaki kontrolne
        if (preg_match('/[\x00-\x1F\x7F]/', $password)) {
            return false;
        }
    
        return true;
    }
    


}