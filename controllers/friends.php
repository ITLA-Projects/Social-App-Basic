<?php

class Friends extends Controller
{

    private $repo;
    private $publicationRepo;
    private $commentRepo;
    private $friendRepo;
    private $userRepo;
    private $auth;

    function __construct()
    {
        parent::__construct();
        $this->repo = new Repository("user");
        $this->publicationRepo = new PublicationRepository();
        $this->commentRepo = new CommentRepository();
        $this->friendRepo = new FriendRepository();
        $this->userRepo = new UserRepository();
        $this->auth = new Auth();

        $this->view->publicationList = array();
        $this->view->commentList = array();
        $this->view->friendList = array();
        //give the main view the user repo
        $this->view->repo = $this->repo;

        //messages for the view
        $this->view->addFriend = "";
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
                $this->view->newPublicationErr = "There was an error trying to create the comment, try later...";
                var_dump($th);
            }
        } else {
            var_dump($_POST);
        }
    }

    function addFriend()
    {
        if (isset($_POST['username'])) {
            $arr = $this->userRepo->GetByUsername($_POST['username']);

            //only proceed if there are something in the array
            if (count($arr) > 0) {


                //test if they are friends already
                $arrarr = $this->friendRepo->GetByUserOneAndUserTwo($this->auth->retrieveUser()->id, $arr[0]->id);

                if (count($arrarr) > 0) {
                    $this->view->addFriend = "You already are friend of this user";
                    $this->render();
                } else {

                    //last test - if is yourself, ignore
                    if ($_POST['username'] === $this->auth->retrieveUser()->username) {
                        $this->view->addFriend = "You cannot add yourself as a friend.";
                        $this->render();
                    } else {
                        //exists, but they are not friends yet so add both and go ahead
                        $friendComb1 = new Friend();
                        $friendComb1->initializeData(0, $this->auth->retrieveUser()->id, $arr[0]->id, 1);
                        $friendComb2 = new Friend();
                        $friendComb2->initializeData(0, $arr[0]->id, $this->auth->retrieveUser()->id, 1);


                        $this->friendRepo->Create($friendComb1);
                        $this->friendRepo->Create($friendComb2);

                        header("Location: " . constant('URL') . "friends");
                        exit();
                    }
                }
            } else {
                //if the array is empty there is no user with this name
                $this->view->addFriend = "There is no user with this username, keep searching..";
                $this->render();
            }
        } else {
            $this->view->addFriend = "complete the field before search";
            $this->render();
        }
    }

    function deleteFriend()
    {
        if (isset($_GET['id'])) {
            try {
                $this->friendRepo->DeleteByUserOneAndUserTwo($this->auth->retrieveUser()->id, (int) $_GET['id']);
                $this->friendRepo->DeleteByUserOneAndUserTwo((int) $_GET['id'], $this->auth->retrieveUser()->id);
                header("Location: " . constant('URL') . "friends");
                exit();
            } catch (\Throwable $th) {
                var_dump($th);
            }
        }
    }

    function render()
    {
        //before render, you need to check the authentication

        //does a user exists? go render
        if ($this->auth->checkAuthentication()) {

            //create temp variables
            $tempFriendList = array();
            $tempPublicationList = array();
            $tempCommentList = array();



            //bring me the id to work with it
            $userId = $this->auth->retrieveUser()->id;

            //bring me the friendlist
            $tempArr = $this->friendRepo->GetByUserOne($userId);
            foreach ($tempArr as $element) {
                array_push($tempFriendList, $this->repo->GetById($element->userTwo));
            }

            //loop for each friend and retrieve any publication
            foreach ($tempFriendList as $friend) {
                $tempPublicationList = array_merge($tempPublicationList, $this->publicationRepo->GetByOwner($friend->id));
            }

            //loop foreach the publications to get an array of comments
            foreach ($tempPublicationList as $publication) {
                $tempCommentList = array_merge($tempCommentList, $this->commentRepo->GetByPublication($publication->id));
            }

            //save the view variables
            $this->view->friendList = $tempFriendList;
            $this->view->publicationList = $tempPublicationList;
            $this->view->commentList = $tempCommentList;

            $this->view->render('friends/index');
        } else {
            //it does not? redirect to login
            header("Location: " . constant('URL') . "login");
            exit();
        }
    }
}
