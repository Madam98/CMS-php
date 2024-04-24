<?php

require_once (Settings::PATH['entities'].'/post.entity.php');
require_once (Settings::PATH['utils'].'/image.utils.php');
require_once (Settings::PATH['models'].'/image.model.php');
class Post {
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
            $sql = "SELECT * FROM POST WHERE status = 1";
			$stm = $this->pdo->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_CLASS, 'PostEntity');
		}
		catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function getOne($id) {
		try {
            $sql = "SELECT * FROM POST WHERE post_id = ?";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute(array($id));
			$stm->setFetchMode(PDO::FETCH_CLASS, 'PostEntity');
			return $stm->fetch();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getByCategoryId($id) {
		try {
            $sql = "SELECT * FROM POST WHERE category_id = ?";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute(array($id));
			return $stm->fetchAll(PDO::FETCH_CLASS, 'PostEntity');
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	
	public function getImageFromId($id) {
		try {
            $sql = "SELECT IMAGE FROM POST WHERE post_id = ?";
			$stm = $this->pdo->prepare($sql);          
            $stm->execute(array($id));
			return $stm->fetch();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getPostFromId($id) {
		try {
            $sql = "SELECT IMAGE FROM POST WHERE post_id = ?";
			$stm = $this->pdo->prepare($sql);          
            $stm->execute(array($id));
			return $stm->fetch();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getPostFromPhrase($phrase) {
		try {
			$sql = "SELECT * FROM POST WHERE title LIKE ? AND status = 1";
			$stm = $this->pdo->prepare($sql);
	
			// Dodanie znaków % do frazy wyszukiwania
			$searchTerm = "%$phrase%";
			$stm->execute(array($searchTerm));
			return $stm->fetchAll(PDO::FETCH_CLASS, 'PostEntity');
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getCategoryName($id) {
		try {
			$sql = "SELECT name FROM CATEGORY WHERE status = 1";
			$stm = $this->pdo->prepare($sql);
			$stm->execute(array($id));
			return $stm->fetchColumn();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function update($data) {
		try {

			$post = $this->getOne($data->getId());


			if ($data->getImageName()['size'] > 0) {
				$postUtils = new ImageUtils();
				if ($post->getImageName() != NULL){
					$postUtils->removeImage($post->getImageName());
				}

				$image = $postUtils->uploadImage($data->getImageName(), 0); 
				if ($image == Settings::ERRORS['FILE_NOT_UPLOAD']){
					return Settings::ERRORS['FILE_NOT_UPLOAD'];
				}
			}	else {
				$image = $post->getImageName();
			}
			$sql = "UPDATE POST SET 
						title          = ?, 
						subtitle       = ?,
						body		   = ?,					
						status		   = ?,
						category_id    = ?,
						user_id        = ?,
						image_pathname = ?
				    WHERE post_id      = ?";
            $stm = $this->pdo->prepare($sql);
			$stm->execute(array(
					$data->getTitle(),
					$data->getSubtitle(),
					$data->getBody(),
					$data->getStatus(),
					$data->getCategory_id(),
					$data->getUser_id(),
					$image,
					$data->getId()
				));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function insert($data) {
		try {

			$imageUtils = new ImageUtils();

			if ($data->getImageName() != NULL){

				$image = $imageUtils->uploadImage($data->getImageName(), $data->getUser_id()); 
				
				// echo $data->getImageName();
				// echo $image;
				// die();
				// if ($image == Settings::ERRORS['FILE_NOT_UPLOAD'])
				// 	return Settings::ERRORS['FILE_NOT_UPLOAD'];

				$sql = "INSERT INTO POST (title, subtitle, body, status, user_id, image_pathname, category_id) 
						VALUES (?, ?, ?, ?, ?, ?, ?)";
				$stm = $this->pdo->prepare($sql);
				$stm->execute(array(
						$data->getTitle(),
						$data->getSubtitle(),
						$data->getBody(),
						$data->getStatus(),
						$data->getUser_id(),
						$image,
						$data->getCategory_id()
					));
			} else{

				$sql = "INSERT INTO POST (title, subtitle, body, status, user_id, image_pathname, category_id) 
						VALUES (?, ?, ?, ?, ?, ?, ?)";
				$stm = $this->pdo->prepare($sql);
				$stm->execute(array(
						$data->getTitle(),
						$data->getSubtitle(),
						$data->getBody(),
						$data->getStatus(),
						$data->getUser_id(),
						NULL,
						$data->getCategory_id()
					));
			}


		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function delete($id) {
		try {
			$post = $this->getOne($id);
			if ($post->getImageName() != 'default.jpg') 
				$image = new ImageUtils();
				$image->removeImage($post->getImageName());
            $sql = "DELETE FROM POST WHERE post_id = ?";
			$stm = $this->pdo->prepare($sql);			          
			$stm->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

}

