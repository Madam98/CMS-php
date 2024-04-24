<?php
require_once (Settings::PATH['models'].'/post.model.php');
require_once (Settings::PATH['models'].'/category.model.php');
require_once (Settings::PATH['models'].'/user.model.php');
require_once (Settings::PATH['models'].'/comment.model.php');
require_once (Settings::PATH['models'].'/authorization.model.php');

class PostsController {

    public function __CONSTRUCT() {

        
    }

    public function index() {
        $postModel = new Post();
        $authorization = new Authorization();
        $category = new Category();
        $postsController = new PostsController();
        $posts = $postModel->getAll();

        require_once (Settings::PATH['view'].'/layouts/navbars.php');
        require_once (Settings::PATH['view'].'/posts/posts.php');
    }


    public function getstatus() {
        $postModel = new Post();
        $tmp = $postModel->getstatus($_REQUEST['id']);
    }

    public function activate() {
        $postModel = new Post();
        $post = $postModel->getOne($_REQUEST['id']);
        $post->setStatus(1);
        $postModel->update($post);

        header('Location: '.Settings::PATH['base'].'/posts');
    }

    public function createLink($id) {
        $postModel = new Post();
        $stringToCombine = "http://localhost/blogit/post/view/";
        $linkString = $stringToCombine.$id;
        return $linkString;
    }

    public function deactivate() {
        $postModel = new Post();
        $post = $postModel->getOne($_REQUEST['id']);
        $post->setStatus(0);
        $postModel->update($post);

        header('Location: '.Settings::PATH['base'].'/posts');
    }


    public function delete() {
        $postModel = new Post();

        $postModel->delete($_REQUEST['id']);
        header('Location: '.Settings::PATH['base'].'/posts');
    }
}