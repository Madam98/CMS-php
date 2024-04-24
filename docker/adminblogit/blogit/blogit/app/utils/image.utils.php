<?php
require_once (Settings::PATH['models'].'/authorization.model.php');

class ImageUtils {	
    
    public function uploadImage($image, $id) {
        
        //Pobierz nazwe uzytkownika
        $authorization= new Authorization();
        $oneAuthorization = $authorization->getOne($id);

        if (
            ($image['type'] == 'image/gif' ||
            $image['type'] == 'image/jpeg' ||
            $image['type'] == 'image/jpg'  ||
            $image['type'] == 'image/JPG'  ||
            $image['type'] == 'image/pjpeg'||
            $image['type'] == 'image/png') &&
            $image['size'] < 2000000
        ) {
            if (is_uploaded_file($image['tmp_name'])){
                $nameDirectory = Settings::PATH['images'] . '/';
                $idUnique = time();
                $nameFile = $idUnique."-".$image['name'];
                move_uploaded_file ($image['tmp_name'], $nameDirectory.'/'.$nameFile);
                $imageName = $nameFile;
                return $imageName;
            } else {
                return Settings::ERRORS['FILE_NOT_UPLOAD'];
            }
        } else {
            return Settings::ERRORS['FILE_NOT_UPLOAD'];
        }
    }

    public function getPathname($image, $id){
        $authorization= new Authorization();
        $oneAuthorization = $authorization->getOne($id);
        
        $nameDirectory = Settings::PATH['base'] . '/resources/images/'  . $image;
        return $nameDirectory;

    }

    
    public function removeImage($imageName) {
		unlink(Settings::PATH['images'].'/'.$imageName);
	}

}


		// // Utworzenie nazwy pliku bez rozszerzenia (np. "praca")
		// $file_name_without_extension = pathinfo($image_name, PATHINFO_FILENAME);
	
		// // Pobranie aktualnego czasu w mikrosekundach jako 16-znakowy ciąg znaków
		// $microseconds = sprintf("%06d", (int) (microtime(true) * 1000000));
		
		// // Pobranie aktualnego czasu w nanosekundach jako 9-znakowy ciąg znaków
		// $nanoseconds = sprintf("%09d", (int) (hrtime()[1]));
	
		// // Utworzenie pełnego image_pathname z nazwą pliku, user_id, czasem w mikrosekundach i nanosekundach oraz rozszerzeniem
		// $this->image_pathname = Settings::PATH['images'] . '/' . $user_id . '/' . $file_name_without_extension . '_' . date("Y_m_d_H_i_s") . '_' . $microseconds . '_' . $nanoseconds . '.' . pathinfo($image_name, PATHINFO_EXTENSION);