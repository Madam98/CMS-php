<?php
require_once (Settings::PATH['models'].'/post.model.php');
require_once (Settings::PATH['models'].'/category.model.php');
require_once (Settings::PATH['models'].'/user.model.php');
require_once (Settings::PATH['models'].'/comment.model.php');

class PostController {
    private $postModel;
    private $sessionNumber;

    private $error;

    public function __CONSTRUCT() {
        $this->postModel     = new Post();
        $this->categoryModel = new Category();
        $this->userModel     = new User();
        $this->commentModel  = new Comment();
        if ($_SESSION){
            $this->sessionNumber = $_SESSION['user_id'];
        }
    }

    public function index() {
        $posts = $this->getAll();
        $error = $this->error;
        require_once (Settings::PATH['view'].'/post/create.php');
    }

    public function getAll() {
        return $this->postModel->getAll();
    }

    public function getAllCategories(){
        return $this->categoryModel->getAll();
    }

    public function getCategoryName($id){
        return $this->categoryModel->getCategoryName($id);
    }

    public function list() {
        if(isset($_REQUEST['idCategory'])) {
            $posts = $this->postModel->getByCategoryId($_REQUEST['idCategory']);
        }
        else{
            $posts = $this->postModel->getAll();
        }
    }

    public function addComment() {
        $newcomment = new CommentEntity();
        $newcomment->setUsername($_SESSION['username']);
        $newcomment->setBody($_REQUEST['comment']);
        $newcomment->setPost_id($_REQUEST['id']);
        $newcomment->setStatus(1);

        // echo '<pre>';
        // var_dump($newcomment);
        // echo '</pre>';

        $this->commentModel->insert($newcomment);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }


    public function view() {
        if (isset($_REQUEST['id'])){
            $postController = new PostController();
            $post = $this->postModel->getOne($_REQUEST['id']);
        

            if ($post != NULL){
                //var_dump($_SESSION);
                if (($post->getStatus() == 1) || ($_SESSION['user_id'] == 1)){

                    if ($post->getImageName() == ''){
                        $post->setImageName("default.jpg");
                    }
                    
                    //var_dump($post->getImageName());
                    require_once (Settings::PATH['view'].'/banner/post.php');
                    require_once (Settings::PATH['view'].'/post/postDetail.php');
                    //echo $_REQUEST['id'];
                    $commentModel = new Comment();
                    $comments = $commentModel->getByPostId($_REQUEST['id']);
                    require_once (Settings::PATH['view'].'/post/comment.php');
                }
                else{
                    require_once(Settings::PATH['view'].'/error/404.php');
                }
            }
            else{
                require_once(Settings::PATH['view'].'/error/404.php');
            }
        }
    }

    public function returnName($id){
        $user = $this->userModel->getOne($id);
        $value = $user->getName();
        return $value;
    }

    public function returnSurName($id){
        $user = $this->userModel->getOne($id);
        $value = $user->getSurname();
        return $value;
    }

    public function returnImage($image, $id){
        $imageUtils = new ImageUtils();
        $value = $imageUtils->getPathname($image, $id);
        return $value;
    }

    public function edit() {
        $post = new PostEntity();
        $categories = $this->getAllCategories();
        $postController = new PostController();
        if(isset($_REQUEST['id'])) {
            $post = $this->postModel->getOne($_REQUEST['id']);
            $_SESSION['post_id'] = $post->getId();
            $_SESSION['category_id'] = $post->getCategory_id();
        }
        require_once (Settings::PATH['view'].'/banner/update.php');
        require_once (Settings::PATH['view'].'/post/edit.php');
    }

    public function create() {
        $post = new PostEntity();
        $categories = $this->getAllCategories();
        require_once (Settings::PATH['view'].'/banner/create.php');
        require_once (Settings::PATH['view'].'/post/create.php');
    }
    
    public function save() {
        $post  = new PostEntity();
        $image = new ImageEntity();
        //SPRAWDZAMY CZY OTWARTA STRONA WCZESNIEJ A POTEM REAKCJA NA POLECENIE 'CREATE' MA TA SAMA SESJE
        if ($_SESSION['user_id'] != $this->sessionNumber){
            die("Wrong session number!\n postid: " . $_SESSION['user_id'] . "\nSERVER ID: " . $this->sessionNumber);
        }
        if (isset($_REQUEST['post_id'])) {
            $post->setId(  $_REQUEST['post_id']);
            unset($_SESSION['post_id']);
        }
        $post->setTitle($_REQUEST['title']);

        if ($post->getTitle() == "" ){
            $error['TITLE_CAN_NOT_BE_EMPTY!'] = Settings::ERRORS['TITLE_CAN_NOT_BE_EMPTY!'];
        }

        $post->setSubtitle($_REQUEST['subtitle']);
        $post->setBody($_REQUEST['body']);
        $post->setStatus(0);
        $post->setUser_id($_SESSION['user_id']);

        echo $_REQUEST['category_id'];
        if ($_REQUEST['category_id'] != "Open this select menu to set category" && $_REQUEST['category_id'] != ""){
            $post->setCategory_id($_REQUEST['category_id']);

        }else{
            $post->setCategory_id(1);
        }
        
        if (!empty($_FILES['image']['name'])){
            $post->setImageName($_FILES['image']);
        }


        if ($error != null) {      

            $_SESSION['form_values'] = $_POST;    
            $_SESSION['error'] = $error;
            $post->getId() > 0 ? header('Location: '.Settings::PATH['base'].'/post/edit/'.$post->getId()) : header('Location: '.Settings::PATH['base'].'/post/create');
        }



        else{
            $post->getId() > 0 ? $this->postModel->update($post) : $this->postModel->insert($post);
            header('Location: '.Settings::PATH['base'].'/home');
        }
    }
    
    public function delete() {
        //ZABEZPIECZENIE PRZED NIEPOZADANA EDYCJA PRZEZ KOGOS INNEGO
        $post = new PostEntity();
        $post = $this->postModel->getOne($_REQUEST['id']);
        if ($_SESSION['user_id'] == $post->getUser_id()){
            $this->postModel->delete($_REQUEST['id']);
        }
        header('Location: '.Settings::PATH['base'].'/home');
    }
}