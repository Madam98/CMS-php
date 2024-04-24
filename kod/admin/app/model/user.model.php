<?php

require_once (Settings::PATH['entities'].'/user.entity.php');
require_once (Settings::PATH['models'].'/authorization.model.php');
require_once (Settings::PATH['utils'].'/password.utils.php');

class User {
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

	public function userExistsByEmail($email) {
		try {
			$sql = "SELECT COUNT(*) FROM USERS WHERE email = ?";
			$stm = $this->pdo->prepare($sql);
			$stm->execute(array($email));
			$count = $stm->fetchColumn();
	
			return $count > 0; // Zwraca true, jeśli znaleziono co najmniej jednego użytkownika
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

    //GET ALL COLUMNS
	public function getAll() {
		try {
            $sql = "SELECT * FROM USERS";
			$stm = $this->pdo->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_CLASS, 'UserEntity');
		}
		catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function getOne($id) {
		try {
            $sql = "SELECT * FROM USERS WHERE user_id = ?";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute(array($id));
			$stm->setFetchMode(PDO::FETCH_CLASS, 'UserEntity');
			return $stm->fetch();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function getStatus($id) {
		try {
            $sql = "SELECT type_of_users_id FROM USERS WHERE user_id = ?";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute(array($id));
			$stm->setFetchMode(PDO::FETCH_CLASS, 'UserEntity');
			return $stm->fetchColumn();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function getCountUser(){
		try {
			$sql = "SELECT COUNT(*) FROM USERS";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute();
			return $stm->fetchColumn();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getCountAdmin(){
		try {
			$sql = "SELECT COUNT(*) FROM USERS WHERE type_of_users_id=1";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute();
			return $stm->fetchColumn();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getAdmins(){
		try {
			$sql = "SELECT * FROM USERS WHERE type_of_users_id=1";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute(array());
			$stm->setFetchMode(PDO::FETCH_CLASS, 'UserEntity');
			return $stm->fetchAll();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function getUsers(){
		try {
			$sql = "SELECT * FROM USERS WHERE type_of_users_id=2";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute(array());
			$stm->setFetchMode(PDO::FETCH_CLASS, 'UserEntity');
			return $stm->fetchAll();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function countAllAdmins() {
		try {
			$sql = "SELECT COUNT(*) as count FROM USERS WHERE type_of_users_id=1";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute();
			$result = $stm->fetch();
			return $result['count'];
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}




	public function getNameById($id) {
		try {
            $sql = "SELECT Name FROM USERS WHERE user_id = ?";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute(array($id));
			return $stm->fetch();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getSurnameById($id) {
		try {
            $sql = "SELECT Surname FROM USERS WHERE user_id = ?";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute(array($id));
			return $stm->fetch();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function getLastUserId() {
		try {
            $sql = "SELECT user_id FROM USERS ORDER BY user_id DESC LIMIT 1";
			$stm = $this->pdo->prepare($sql);
			$stm->execute();
			return $stm->fetchColumn();
		}
		catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function delete($id) {

		try {
            $sql = "DELETE FROM USERS WHERE user_id = ?";
			$stm = $this->pdo->prepare($sql);			          
            $stm->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function update($data) {
		try {
			$sql = "UPDATE USERS SET 
						name             = ?, 
						surname          = ?,
						email			 = ?,					
						telephone		 = ?,
						address          = ?,
						type_of_users_id = ?
				    WHERE user_id 		 = ?";
            $stm = $this->pdo->prepare($sql);
			$stm->execute(array(
					$data->getName(),
                    $data->getSurname(),
                    $data->getEmail(), 
					$data->getTelephone(),
					$data->getAddress(),
					$data->getIdType(),
					$data->getId()
                ));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

    // TO LOGIN IN INSERT DATA
	public function insert($data) {
		try {
			$authorization = new Authorization();
			
        	// echo '<pre>';
        	// var_dump($data);
        	// echo '</pre>';
			
			// echo $data->getName();
			// echo $data->getSurname();
			// echo $data->getEmail();
			// echo $data->getTelephone();
			// echo $data->getAddress();
			// echo $data->getIdType();
			
			
            $sql = "INSERT INTO USERS (name, surname, email, telephone, address, type_of_users_id) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array(
				$data->getName(),
				$data->getSurname(),
				$data->getEmail(), 
				$data->getTelephone(),
				$data->getAddress(),
				$data->getIdType()
			));			
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	  
}