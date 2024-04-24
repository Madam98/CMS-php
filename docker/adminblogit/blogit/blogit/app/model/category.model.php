<?php
require_once (Settings::PATH['entities'].'/category.entity.php');
require_once (Settings::PATH['models'].'/post.model.php');

class Category {
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
			$sql = "SELECT * FROM CATEGORY WHERE category_id != :excluded_id";
			$stm = $this->pdo->prepare($sql);
			$excluded_id = 1; // ID kategorii do wykluczenia
			$stm->bindParam(':excluded_id', $excluded_id);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_CLASS, 'CategoryEntity');
		}
		catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function getOne($id) {
		try {
            $sql = "SELECT * FROM CATEGORY WHERE category_id = ?";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute(array($id));
			$stm->setFetchMode(PDO::FETCH_CLASS, 'CategoryEntity');
			return $stm->fetch();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getByCategoryFatherId($id) {
		try {
            $sql = "SELECT * FROM CATEGORY WHERE category_father_id = ?";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute(array($id));
			$stm->setFetchMode(PDO::FETCH_CLASS, 'CategoryEntity');
			return $stm->fetch();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getCategoryName($id) {
		try {

            $sql = "SELECT name FROM CATEGORY WHERE category_id = ?";
			$stm = $this->pdo->prepare($sql);          
			$stm->execute(array($id));
			$stm->setFetchMode(PDO::FETCH_CLASS, 'CategoryEntity');
			return $stm->fetchColumn();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function delete($id) {
		try {
			$article = new Post();
			$article->deleteFromCategoryId($id);

            $sql = "DELETE FROM CATEGORY WHERE category_id = ? or category_father_id = ?";
			$stm = $this->pdo->prepare($sql);			          
            $stm->execute(array(
					$id,
					$id
				));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function update($data) {
		try {
			$sql = "UPDATE CATEGORY SET 
						category_father_id  = ?,
						name                = ?
				    WHERE category_id 		= ?";
            $stm = $this->pdo->prepare($sql);
			$stm->execute(array(
                    $data->getIdCategoryFather(),
                    $data->getName(),
                    $data->getId()
                ));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function insert($data) {
		try {

            $sql = "INSERT INTO CATEGORY (category_father_id, name)
                    VALUES (?, ?)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array(
                    $data->getIdCategoryFather(),
                    $data->getName()
				));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

}