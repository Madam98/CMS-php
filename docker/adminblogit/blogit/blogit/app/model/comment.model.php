<?php

require_once (Settings::PATH['entities'].'/post.entity.php');
require_once (Settings::PATH['entities'].'/comment.entity.php');

class Comment {
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
            $sql = "SELECT * FROM COMMENT";
			$stm = $this->pdo->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_CLASS, 'CommentEntity');
		}
		catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function getOne($id) {
		try {
            $sql = "SELECT * FROM COMMENT WHERE comment_id = ?";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute(array($id));
			$stm->setFetchMode(PDO::FETCH_CLASS, 'CommentEntity');
			return $stm->fetch();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getByPostId($id) {
		try {
            $sql = "SELECT * FROM COMMENT WHERE post_id = ?";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute(array($id));
			$stm->setFetchMode(PDO::FETCH_CLASS, 'CommentEntity');
			return $stm->fetchAll();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function insert($data) {
		try {
            $sql = "INSERT INTO COMMENT (username, body, status, post_id) 
                    VALUES (?, ?, ?, ?)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array(
					$data->getUsername(),
					$data->getBody(),
					$data->getStatus(),
					$data->getPost_id()
				));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function delete($id) {
		try {
			$post = $this->getOne($id);
			if ($post->getImageName() != null) 
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

