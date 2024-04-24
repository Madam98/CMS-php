<?php

require_once(Settings::PATH['models'].'/category.model.php');
require_once(Settings::PATH['entities'].'/category.entity.php');


class CategoriesController {
    
    private $categoryModel;

    public function __construct() {
        $this->categoryModel = new Category();
        $this->category = new CategoryEntity();
    }
    
    public function index() {

        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        // echo '<pre>';
        // var_dump($admins);
        // echo '</pre>';
        // die();

        require_once (Settings::PATH['view'].'/layouts/navbars.php');
        require_once (Settings::PATH['view'].'/categories/categories.php');
    }


    public function create() {
        require_once (Settings::PATH['view'].'/layouts/navbars.php');
        require_once (Settings::PATH['view'].'/categories/create.php');
    }
    
    public function validate() {
        if (isset($_REQUEST['category']) && strlen($_REQUEST['category']) < 13) {
            $this->categoryModel->insert($_REQUEST['category']);
            header('Location: '.Settings::PATH['base'].'/categories');
        } else {
            header('Location: '.Settings::PATH['base'].'/categories/create');
        }
    }


    public function update() {
        $categoryModel = new Category();
        $category = $categoryModel->getOne($_REQUEST['id']);
        require_once (Settings::PATH['view'].'/layouts/navbars.php');
        require_once (Settings::PATH['view'].'/categories/update.php');
    }

    public function updatecategory() {
        $categoryModel = new Category();
        $category = $categoryModel->getOne($_REQUEST['id']);
        $category->setName($_REQUEST['category']);
        $this->categoryModel->update($category);
        header('Location: '.Settings::PATH['base'].'/categories');
    }

    public function delete() {
        $categoryModel = new Category();
        $categoryModel->delete($_REQUEST['id']);
        
        header('Location: '.Settings::PATH['base'].'/categories');
    }



    

}