<?php

require_once(Settings::PATH['models'].'/comment.model.php');
require_once(Settings::PATH['models'].'/post.model.php');
require_once(Settings::PATH['models'].'/user.model.php');


class CommentsController {
    
    public function __construct() {
    }
    
    public function index() {

        $commentModel = new Comment();
        $userModel = new User();
        $postModel = new Post();
        $commentsController = new CommentsController();
        $comments = $commentModel->getAll();
        require_once (Settings::PATH['view'].'/layouts/navbars.php');
        require_once (Settings::PATH['view'].'/comments/comments.php');
    }


    public function createLink($id) {
        $postModel = new Post();
        $stringToCombine = "http://localhost/blogit/post/view/";
        $linkString = $stringToCombine.$id;
        return $linkString;
    }

    public function activate() {
        $commentModel = new Comment();
        $comment = $commentModel->getOne($_REQUEST['id']);
        $comment->setStatus(1);
        $commentModel->update($comment);

        header('Location: '.Settings::PATH['base'].'/comments');
    }

    public function deactivate() {
        $commentModel = new Comment();
        $comment = $commentModel->getOne($_REQUEST['id']);
        $comment->setStatus(0);
        $commentModel->update($comment);

        header('Location: '.Settings::PATH['base'].'/comments');
    }

    public function delete() {
        $commentModel = new Comment();
        $commentModel->delete($_REQUEST['id']);
        header('Location: '.Settings::PATH['base'].'/comments');
    }

}