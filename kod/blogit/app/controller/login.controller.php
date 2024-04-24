<?php
require_once (Settings::PATH['models'].'/user.model.php');
require_once (Settings::PATH['models'].'/authorization.model.php');
require_once (Settings::PATH['utils'].'/password.utils.php');

class LoginController {
    
    private $userModel;
    
    public function __CONSTRUCT() {
        $this->userModel = new User();
        $this->authorizationModel = new Authorization();
    }
    
    public function index() {
        $authorization = new authorizationEntity();
        require_once (Settings::PATH['view'].'/banner/login.php');
        require_once (Settings::PATH['view'].'/auth/login.php');
    }

    public function getAll() {
        return $this->userModel->getAll();
    }
    
    public function validate() {
        try {
            
            // Pobieranie informacji o użytkowniku na podstawie nazwy użytkownika
            $authorizationEntity = $this->authorizationModel->getIdByUsername($_REQUEST['username']);
            
            if (!$authorizationEntity) {
                // Użytkownik nie został znaleziony
                $error['USER_NOT_FOUND'] = Settings::ERRORS['USER_NOT_FOUND'];
                // Tutaj można dodać obsługę błędu, np. wyświetlić komunikat
            } else {
                // Sprawdzenie hasła
                $passwordUtils = new PasswordUtils();
                if (!$passwordUtils->verify($_REQUEST['password'], $authorizationEntity->getPassword())) {
                    $error['INVALID_PASSWORD'] = Settings::ERRORS['INVALID_PASSWORD'];
                    // Obsługa błędnego hasła, np. wyświetlenie komunikatu
                } else {
                    // Logowanie zakończone sukcesem
                    // Logowanie zakończone sukcesem - Ustawianie zmiennych sesji
                    $_SESSION['user_id'] = $authorizationEntity->getUserId();
                    $_SESSION['username'] = $authorizationEntity->getUsername();
                    // Możesz ustawić więcej zmiennych sesji, jeśli potrzebujesz
                    
                    header('Location: ' . Settings::PATH['base'] . '/home');
                    //exit();
                }
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    
        if (!empty($error)) {
            // Jeśli wystąpiły błędy, wyświetl formularz ponownie z komunikatami o błędach
            $_SESSION['form_values'] = $_POST;    
            $_SESSION['error'] = $error;
            header('Location: '.Settings::PATH['base'].'/login');
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ' . Settings::PATH['base'] . '/home');
    }
    


}