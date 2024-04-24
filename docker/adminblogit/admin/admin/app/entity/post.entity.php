<?php

class PostEntity {	
	//class properties
    private $id;
    private $title;
    private $subtitle;
	private $body;
	private $status;
	private $user_id;
	private $image_name;
	private $image_pathname;
	private $category_id;
	private $createdAt;


    private $post_id;
	private $user_id_string;
    private $category_id_string;

    private $createdAt_string;

	public function __CONSTRUCT() {
		try {			
			//convert properties of db to class and destruct these properties
				$this->id = (int) $this->post_id;
				unset($this->post_id);

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
	
	public function getTitle() {
		return $this->title;
	}

	public function setTitle(string $title) {
		$this->title = $title;
	}

	public function getSubtitle() {
		return $this->subtitle;
	}

	public function setSubtitle(string $subtitle) {
		$this->subtitle = $subtitle;
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

	public function setStatus($status){
		$this->status = $status;
	}

	public function getUser_id() {
		return $this->user_id;
	}

	public function setUser_id($user_id) {
		$this->user_id = $user_id;
	}

	public function getImageName() {
		return $this->image_pathname;
	}

	public function setImageName($image_pathname) {
		$this->image_pathname = $image_pathname;
	}

	public function getCategory_id() {
		return $this->category_id;
	}

	public function setCategory_id($category_id) {
		$this->category_id = $category_id;
	}

	public function getCreatedAt() {
		return $this->createdAt;
	}

	public function setCreatedAt($createdAt){
		$this->createdAt = $createdAt;
	}

}