<?php
require_once (Settings::PATH['entities'].'/authorization.entity.php');

class UserEntity extends AuthorizationEntity{
	//class properties
	private $id;
	private $username;
    private $name;
	private $surname;
	private $email;
	private $telephone;
	private $address;
	private $password;
	private $idType;

	//db properties to convert
	private $user_id;
	private $type_id;

	public function __CONSTRUCT() {
		try {
			//convert properties of db to class and destruct these properties
			$this->id = (int) $this->user_id;
			$this->idType = (int) $this->type_id;
			unset($this->user_id);
			unset($this->type_id);			
		}
		catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function getId() {
		return $this->id;
	}


	public function setId($id) {
		$this->id = $id;
	}

	public function getName() {
		return $this->name;
	}

	public function setName(string $name) {
		$this->name = $name;
	}

	public function getSurname() {
		return $this->surname;
	}

	public function setSurname(string $surname) {
		$this->surname = $surname;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail(string $email) {
		$this->email = $email;
	}

	public function getTelephone() {
		return $this->telephone;
	}

	public function setTelephone(?string $telephone) {
		$this->telephone = $telephone;
	}

	public function getAddress() {
		return $this->address;
	}

	public function setAddress(?string $address) {
		$this->address = $address;
	}

	public function getIdType() {
		return $this->idType;
	}

	public function setIdType(int $idType) {
		$this->idType = $idType;
	}
	  
}