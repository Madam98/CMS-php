<?php
require_once (Settings::PATH['entities'].'/authorization.entity.php');
require_once (Settings::PATH['utils'].'/password.utils.php');

class Authorization {
	private $pdo;

	public function __CONSTRUCT() {
		try {
			$database = new Database();
			$this->pdo = $database->StartUp();  		
		}
		catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function getAll() {
		try {
            $sql = "SELECT * FROM AUTHORIZATION";
			$stm = $this->pdo->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_CLASS, 'AuthorizationEntity');
		}
		catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function getOne($id) {
		try {
            $sql = "SELECT * FROM AUTHORIZATION WHERE user_id = ?";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute(array($id));
			$stm->setFetchMode(PDO::FETCH_CLASS, 'AuthorizationEntity');
			return $stm->fetch();
		} catch (Exception $e) {
			die($e->getMessage());
		}
    }

	public function getByUsername($username) {
		try {
            $sql = "SELECT COUNT(*) FROM AUTHORIZATION WHERE username = ?";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute(array($username));
			$count = $stm->fetchColumn();
			return $count > 0;
		} catch (Exception $e) {
			die($e->getMessage());
		}
    }


    public function getIdByUsername($username) {
        try {
            $sql = "SELECT * FROM AUTHORIZATION WHERE username = ?";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute(array($username));
			$stm->setFetchMode(PDO::FETCH_CLASS, 'AuthorizationEntity');
			return $stm->fetch();
		} catch (Exception $e) {
			die($e->getMessage());
		}
    }
    
    public function getAuthorizationByUserData($data) {
        $authorization = new AuthorizationEntity();
        
        $authorization->setPassword($data->getPassword());
        $authorization->setUsername($data->getUsername());
        return $authorization;
    }


	public function delete($id) {
		try {
            $sql = "DELETE FROM AUTHORIZATION WHERE user_id = ?";
			$stm = $this->pdo->prepare($sql);			          
            $stm->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}
    }
    
    public function deleteFromUserId($id) {
		try {
            $sql = "DELETE FROM AUTHORIZATION WHERE user_id = ?";
			$stm = $this->pdo->prepare($sql);			          
            $stm->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function update($data) {
		try {
			$passwordEncrypt = new PasswordUtils();
			$password = $passwordEncrypt->encrypt($data->getPassword());
			$sql = "UPDATE AUTHORIZATION SET 
						username		    = ?,
						password            = ?
				    WHERE user_id 	= ?";
            $stm = $this->pdo->prepare($sql);
			$stm->execute(array(
					$data->getUsername(),                        
					$password,
					$data->getAuthorizationId()
                ));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function insert($data) {
		try {
			$passwordEncrypt = new PasswordUtils();
			$password = $passwordEncrypt->encrypt($data->getPassword());

            $sql = "INSERT INTO AUTHORIZATION (user_id, username, password) 
                    VALUES (?, ?, ?)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array(
                    $data->getUserId(),
					$data->getUsername(),                        
					$password
				));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	  
}