<?php

require_once ('app/core/db.tables.php');


class CreateDatabase extends Database {

    public function createDatabase() {
        // Używamy połączenia mysqli, ponieważ PDO nie pozwala na dynamiczne tworzenie baz danych
        //$conn = new mysqli(
        //    $this->host, 
        //    $this->user, 
        //    $this->pass,
		//	$this->server);

		$conn = new mysqli(
            'localhost',
            'user',
            'user',
			);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // Usunięcie istniejącej bazy danych, jeśli istnieje
        if ($conn->query("DROP DATABASE IF EXISTS $this->dbname") === TRUE) {
            echo "Existing database deleted successfully<br>";
        } else {
            die("Error deleting database: " . $conn->error);
        }
		
		

        if ($conn->query("CREATE DATABASE IF NOT EXISTS $this->dbname CHARACTER SET utf8 COLLATE utf8_general_ci") === TRUE) {
            echo "Database created successfully<br>";
        } else {
            die("Error creating database: " . $conn->error);
        }
        $conn->close();
		

    }

    public function createTables() {
        $pdo = $this->StartUp();
        foreach (DatabaseTables::SQLtables() as $query) {
            if ($pdo->exec($query) === false) {
                throw new Exception("Error creating table: " . join(", ", $pdo->errorInfo()));
            } else {
                echo "Table created<br>"; 
            }
        }
        echo "All tables created successfully<br><br>";
    }    

    public function updateTables(){
        $pdo = $this->StartUp();
        foreach (DatabaseTables::SQLinsert() as $query) {
            if ($pdo->exec($query) === false) {
                throw new Exception("Error updating table: " . join(", ", $pdo->errorInfo()));
            } else {
                echo "Table updated<br>"; 
            }
        }
        echo "All tables updated successfully<br><br>";



        // $query = "SELECT username FROM AUTHORIZATION";
        // $stmt = $pdo->prepare($query);
        // $stmt->execute();
        
        // // Przechodzenie przez wyniki zapytania
        // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //     $username = $row['username'];
        //     $fullPath = Settings::PATH['images'] . '/' . $username;
        
        //     if (!file_exists($fullPath)) {
        //         mkdir($fullPath, 0777, true);
        //         echo "Folder dla użytkownika '$username' został utworzony.<br>";
        //     } else {
        //         echo "Folder dla użytkownika '$username' już istnieje.<br>";
        //     }
        // }
    }

}



