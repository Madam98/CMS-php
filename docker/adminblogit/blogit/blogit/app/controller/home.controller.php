<?php

require_once(Settings::PATH['controllers'].'/post.controller.php');
require_once (Settings::PATH['models'].'/post.model.php');

class HomeController {
    
    public function __construct() {
    }
    
    public function index() {

        // Wywołanie PostController i inne logiki
        $postController = new PostController();
        $categoryModel = new Category();
        
        $posts = $postController->getAll();
        $categories = $categoryModel->getAll();
        
        require_once (Settings::PATH['view'].'/banner/home.php');
        require_once (Settings::PATH['view'].'/post/postWithoutCategory.php');
    }

    public function category() {

        $postController = new PostController();
        $postModel = new Post();
        $posts = $postModel->getByCategoryId($_REQUEST['idCategory']);


        require_once (Settings::PATH['view'].'/banner/home.php');
        require_once (Settings::PATH['view'].'/post/postWithCategory.php');
    }

    public function search(){

        $postController = new PostController();
        $postModel = new Post();
        //funkcja do wyszukiwania postow
        $posts = $postModel->getPostFromPhrase($_REQUEST['search']);


        // echo $_REQUEST['search'];

        // Wypisanie zawartości zmiennej $posts
        // echo '<pre>';
        // var_dump($posts);
        // echo '</pre>';

        //die();
        require_once (Settings::PATH['view'].'/banner/home.php');
        require_once (Settings::PATH['view'].'/post/postSearch.php');

    }


}