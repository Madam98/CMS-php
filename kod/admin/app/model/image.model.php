<?php
require_once (Settings::PATH['entities'].'/image.entity.php');
require_once (Settings::PATH['utils'].'/image.utils.php');

class Image {
	private $pdo;

	public function __CONSTRUCT() {
		try {
			//$this->pdo = Database::StartUp();    
		}
		catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function getAll() {
		try {
            $sql = "SELECT * FROM IMAGE";
			$stm = $this->pdo->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_CLASS, 'ImageEntity');
		}
		catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function getOne($id) {
		try {
            $sql = "SELECT * FROM IMAGE WHERE image_id = ?";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute(array($id));
			$stm->setFetchMode(PDO::FETCH_CLASS, 'ImageEntity');
			return $stm->fetch();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getByArticleId($id) {
		try {
			$sql = "SELECT * FROM IMAGE WHERE article_id = ?";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute(array($id));
			return $stm->fetchAll(PDO::FETCH_CLASS, 'ImageEntity');
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getPictureFromId($id) {
		try {
            $sql = "SELECT image_pathname FROM IMAGE WHERE image_id = ?";
			$stm = $this->pdo->prepare($sql);          
            $stm->execute(array($id));
			return $stm->fetch();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function delete($id) {
		try {
			$picture = $this->getOne($id);
			//if ($picture->getPicture() != null)
				//PictureUtils::removePicture($picture->getPicture());
			
			$sql = "DELETE FROM IMAGE WHERE image_id = ?";
			$stm = $this->pdo->prepare($sql);			          
			$stm->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function deleteFromArticleId($id) {
		try {
            $sql = "DELETE FROM IMAGE WHERE image_id IN 
						(SELECT image_id WHERE post_id = ?)";
			$stm = $this->pdo->prepare($sql);			          
            $stm->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function update($data) {
		try {
			$picture = $this->getOne($data->getId());
			if ($data->getPicture()['size'] > 0) {
				//if ($picture->getPicture() != null)
					//PictureUtils::removePicture($picture->getPicture());
				//$pictureName = PictureUtils::uploadPicture($data->getPicture()); 
				//if ($pictureName == Settings::ERRORS['FILE_NOT_UPLOAD'])
					//return Settings::ERRORS['FILE_NOT_UPLOAD'];
			} else
				$pictureName = $picture->getPicture();

			$sql = "UPDATE IMAGE SET 
						picture				= ?,					
						description         = ?,
						article_id			= ?
				    WHERE picture_id 		= ?";
            $stm = $this->pdo->prepare($sql);
			$stm->execute(array(
					$pictureName,
                    $data->getDescription(),
					$data->getIdArticle(),
					$data->getId()
                ));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	// public function insert($data) {
	// 	try {
	// 		$picture = PictureUtils::uploadPicture($data->getPicture());
	// 		if ($picture == Settings::ERRORS['FILE_NOT_UPLOAD'])
	// 			return Settings::ERRORS['FILE_NOT_UPLOAD'];

    //         $sql = "INSERT INTO CMS_PICTURES (picture, description, article_id) 
    //                 VALUES (?, ?, ?)";
    //         $stm = $this->pdo->prepare($sql);
    //         $stm->execute(array(
	// 				$picture, 
	// 				$data->getDescription(),
	// 				$data->getIdArticle()
    //             ));
	// 	} catch (Exception $e) {
	// 		die($e->getMessage());
	// 	}
	// }
	  
}