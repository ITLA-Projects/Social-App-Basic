<?php

class Main extends Controller
{

    private $repo;
    private $publicationRepo;
    private $commentRepo;
    private $auth;

    function __construct()
    {
        parent::__construct();
        $this->repo = new Repository("user");
        $this->publicationRepo = new PublicationRepository();
        $this->commentRepo = new CommentRepository();
        $this->auth = new Auth();


        $this->view->publicationList = array();
        $this->view->commentList = array();
        $this->view->publicationTarget = "";
        //give the main view the user repo
        $this->view->repo = $this->repo;

        //error messages
        $this->view->newPublicationErr = "";
    }

    function newPublication()
    {

        //check if these values exists first
        if (isset($_POST['title']) && isset($_POST['body'])) {

            try {
                $publication = new Publication();
                $date = new DateTime();
                $publication->initializeData(0, $this->auth->retrieveUser()->id, $_POST['title'], $_POST['body'], $date->format('Y-m-d H:i:s'));

                $this->publicationRepo->Create($publication);

                $this->render();
            } catch (\Throwable $th) {
                $this->view->newPublicationErr = "There was an error trying to create the publication, try later...";
                var_dump($th);
            }
        } else {
            var_dump($_POST);
        }
    }

    function editPublication()
    {
        //check if these values exists first
        if (isset($_POST['title']) && isset($_POST['body']) && isset($_POST['id']) && isset($_POST['owner'])) {

            try {
                $publication = new Publication();
                $date = new DateTime();
                $publication->initializeData($_POST['id'], $_POST['owner'], $_POST['title'], $_POST['body'], $date->format('Y-m-d H:i:s'));

                $this->publicationRepo->Update($publication);

                $this->render();
            } catch (\Throwable $th) {
                $this->view->newPublicationErr = "There was an error trying to create the publication, try later...";
                var_dump($th);
            }
        } else {
            var_dump($_POST);
        }
    }

    function deletePublication()
    {
        var_dump((int) $_GET['id']);
        if (isset($_GET['id'])) {
            try {
                $this->publicationRepo->Delete((int) $_GET['id']);
                header("Location: " . constant('URL'));
                exit();
            } catch (\Throwable $th) {
                var_dump($th);
            }
        }
    }

    function newComment()
    {
        //check if these values exists first
        if (isset($_POST['body']) && isset($_POST['publication'])) {

            try {
                $comment = new Comment();
                $date = new DateTime();
                $comment->initializeData(0, $this->auth->retrieveUser()->id, $_POST['publication'], $_POST['body'], $date->format('Y-m-d H:i:s'));

                $this->commentRepo->Create($comment);

                $this->render();
            } catch (\Throwable $th) {
                $this->view->newPublicationErr = "There was an error trying to create the publication, try later...";
                var_dump($th);
            }
        } else {
            var_dump($_POST);
        }
    }

    function render()
    {
        //before render, you need to check the authentication

        //does a user exists? go render
        if ($this->auth->checkAuthentication()) {

            //create temp variables
            $tempPublicationList = array();
            $tempCommentList = array();

            //bring me the id to work with it
            $userId = $this->auth->retrieveUser()->id;

            //get the publication list
            $tempPublicationList = $this->publicationRepo->GetByOwner($userId);


            //loop foreach the publications to get an array of comments
            foreach ($tempPublicationList as $publication) {
                $tempCommentList = array_merge($tempCommentList, $this->commentRepo->GetByPublication($publication->id));
            }

            //save the view variables
            $this->view->publicationList = $tempPublicationList;
            $this->view->commentList = $tempCommentList;

            $this->view->render('index');
        } else {
            //it does not? redirect to login
            header("Location: " . constant('URL') . "login");
            exit();
        }
    }
}
