<?php

class CommentEntity {	
	//class properties
    private $id;
    private $username;
    private $body;
	private $status;
	private $post_id;
	private $createdAt;

    private $comment_id;

	public function __CONSTRUCT() {
		try {			
			//convert properties of db to class and destruct these properties
				$this->id = (int) $this->comment_id;
				unset($this->comment_id);
			if (isset($this->created_at)) {
				$date = new DateTime($this->created_at);
				$this->createdAt = $date->format('Y-m-d H:i:s'); // Formatowanie daty
			}
 			// Inicjalizacja właściwości obiektu i inne operacje
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
	
	public function getUsername() {
		return $this->username;
	}

	public function setUsername(string $username) {
		$this->username = $username;
	}

	public function getBody() {
		return $this->body;
	}

	public function setBody(string $body) {
		$this->body = $body;
	}

	public function getStatus() {
		return $this->status;
	}

	public function setStatus(string $status) {
		$this->status = $status;
	}

	public function getPost_id() {
		return $this->post_id;
	}

	public function setPost_id($post_id) {
		$this->post_id = $post_id;
	}
	public function getCreatedAt() {
		return $this->createdAt;
	}

	public function setCreatedAt($createdAt){
		$this->createdAt = $createdAt;
	}


}