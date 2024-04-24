<?php

require_once(Settings::PATH['models'].'/post.model.php');
require_once(Settings::PATH['models'].'/category.model.php');
require_once(Settings::PATH['models'].'/user.model.php');

class HomeController {
    
    public function __construct() {
    }
    
    public function index() {

        //pobierz informacje o posts, categories i admins
        $postModel = new Post();
        $categoryModel = new Category();
        $userModel = new User();

        $posts = $postModel->getCountPost();
        $categories = $categoryModel->getCountCategory();
        $users = $userModel->getCountUser();
        $admins = $userModel->getCountAdmin();

        require_once (Settings::PATH['view'].'/layouts/navbars.php');
        require_once (Settings::PATH['view'].'/admin/home.php');
    }
}