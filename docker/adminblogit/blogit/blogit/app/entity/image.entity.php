<?php

class ImageEntity {
	//class properties
    private $id;
	private $picture;
    private $description;
	private $idPost;

	//db properties to convert
	private $picture_id;
	private $post_id;

	public function __CONSTRUCT() {
		try {
			//convert properties of db to class and destruct these properties
			$this->id = (int) $this->picture_id;
			$this->idPost = (int) $this->post_id;
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

	public function getPicture() {
		return $this->picture;
	}

	public function setPicture($picture) {
		$this->picture = $picture;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription(string $description) {
		$this->description = $description;
	}

	public function getIdPost() {
		return $this->idPost;
	}

	public function setIdPost(int $idPost) {
		$this->idPost = $idPost;
	}
	  
}