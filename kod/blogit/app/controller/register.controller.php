<?php
require_once (Settings::PATH['models'].'/user.model.php');
require_once (Settings::PATH['models'].'/authorization.model.php');

class RegisterController {
    
    private $userModel;

    private $error;
    
    public function __CONSTRUCT() {
        $this->userModel = new User();
        $this->authorizationModel = new Authorization();
    }
    
    public function index() {
 

        $user = new UserEntity();
        $error = $this->error;
        require_once (Settings::PATH['view'].'/banner/register.php');
        require_once (Settings::PATH['view'].'/auth/register.php');
    }

    public function getAll() {
        return $this->userModel->getAll();
    }
    public function create() {
        $user = new UserEntity();
    }

    public function save() {
        $user          = new UserEntity();
        $authorization = new AuthorizationEntity();


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

        if ($this->userModel->userExistsByEmail($user->getEmail()) ){
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
        $user->setIdType(2);
        

            
            //7
            $authorization->setUsername($_REQUEST['username']);
            if ($authorization->getUsername() == "" ){
                $error['USERNAME_CAN_NOT_BE_EMPTY!'] = Settings::ERRORS['USERNAME_CAN_NOT_BE_EMPTY!'];
            }

            if ($this->authorizationModel->getByUsername($_REQUEST['username']) ){
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
                header('Location: '.Settings::PATH['base'].'/register');
            }
            else{
                //INSERT
                $this->userModel->insert($user);  
                $authorization->setUserId((int) $this->userModel->getLastUserId());
                $this->authorizationModel->insert($authorization);
                header('Location: '.Settings::PATH['base'].'/login');
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
    


    public function validate() {
        $authorization = new AuthorizationEntity();
        $user = new UserEntity();

        $user = $this->userModel->getOne($_REQUEST['idUser']);
        $authorization->setAuthorizationId($_REQUEST['idAuth']);
        $authorization->setUsername($_REQUEST['username']);
        $authorization->setPassword($_REQUEST['newPassword']);
        
        $currentPassword = $this->authorizationModel->getOne($_REQUEST['idAuth'])->getPassword(); 
        $password = new PasswordUtils();
        if (!$password->verify($_REQUEST['currentPassword'], $currentPassword)) {
            $error['INVALID_PASSWORD'] = Settings::ERRORS['INVALID_PASSWORD'];
        }
        if ($authorization->getPassword() != $_REQUEST['repeatPassword']) {
            $error['PASSWORDS_NOT_MATCH'] = Settings::ERRORS['PASSWORDS_NOT_MATCH'];           
        } 
        if ($error != null) {
            header('Location: '.Settings::PATH['base'].'/register');
        }
        else {
            $this->save($authorization);
        }
    }


}