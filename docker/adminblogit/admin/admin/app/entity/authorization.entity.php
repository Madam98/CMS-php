<?php

class AuthorizationEntity {
	//class properties
	private $idUser;
	private $username;
	private $password;

	//db properties to convert
	private $user_id;

	public function __CONSTRUCT() {
		try {
			//convert properties of db to class and destruct these properties
			$this->idUser = (int) $this->user_id;
			unset($this->authorization_id);
			unset($this->user_id);			
		}
		catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function getUserId() {
		return $this->idUser;
	}

	public function setUserId(string $idUser) {
		$this->idUser = $idUser;
	}

	public function getUsername() {
		return $this->username;
	}

	public function setUsername(string $username) {
		$this->username = $username;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setPassword(string $password) {
		$this->password = $password;
	}
	  
}