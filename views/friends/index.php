<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Login - Social Network</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/bootstrap.min.css" type="text/css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/login.css" type="text/css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/default.css" type="text/css">

</head>

<body class="">
    <?php require 'views/layouts/header.php' ?>

    <!-- HERE STARTS YOUR PAGE -->

    <div class="w-75 m-auto row">
        <main class="col-md-9">
            <!-- tittle -->
            <div class="d-flex align-items-center justify-content-between p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
                <div class="d-flex align-items-center">
                    <img class="mr-3" src="<?php echo constant('URL'); ?>public/images/publications.png" alt="" width="48" height="48">
                    <div class="lh-100">
                        <h1 class="mb-0 text-dark lh-100">Friend's Publications</h6>
                    </div>
                </div>
            </div>


            <!-- EACH PUBLICATION ITERATION -->
            <?php if (count($this->publicationList) > 0) : ?>

                <?php foreach ($this->publicationList as $key => $publication) : ?>

                    <div class="my-3 p-3 bg-white rounded shadow-sm">
                        <div class="">
                            <div class="d-flex align-items-center justify-content-between">
                                <h2 class="border-bottom border-gray pb-2 mb-0"><?php echo $publication->title ?></h2>
                                <div class="d-flex justtify-content-end">
                                    <h2 class="border-bottom border-gray pb-2 mb-0">@<?php echo $this->repo->GetById($publication->owner)->username; ?></h2>
                                </div>

                            </div>
                            <div class="media text-muted pt-3">
                                <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                                    <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
                                </svg>
                                <h4 class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                                    <strong class="d-block text-gray-dark">
                                        <?php echo $publication->body ?>
                                </h4>
                                </strong>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-start">
                                    <small>
                                        Published the <?php echo $publication->date ?>
                                    </small>
                                </div>
                            </div>
                            <!-- EACH COMMENT ITERATION -->
                            <?php foreach (array_filter($this->commentList, function ($comment) use (&$publication) {
                                return $comment->publication === $publication->id;
                            }) as $key => $comment) : ?>
                                <div class="card text-right mt-3">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $this->repo->GetById((int) $comment->owner)->firstname; ?> Says</h5>
                                        <p class="card-text m-0 p-0"><?php echo $comment->body ?></p>
                                        <small class="card-subtitle text-muted m-0 p-0">Published at: <?php echo $comment->date ?></small>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!-- END OF THE COMMENT ITERATION -->

                            <!-- COMMENT SHOW HERE -->
                            <div>
                                <div class="mt-4 d-block text-right">
                                    <button type="submit" class="btn btn-outline-primary writeCommentButton">Write a Commnet</button>
                                </div>

                                <div class="mt-4 d-none">
                                    <form action="<?php echo constant('URL'); ?>friends/newComment" method="POST">
                                        <input type="hidden" id="publication" name="publication" value="<?php echo $publication->id; ?>">

                                        <div class="form-group">
                                            <label for="body">Write a comment</label>
                                            <textarea class="form-control" id="body" name="body" rows="3"></textarea>
                                        </div>
                                        <div class="text-right">
                                            <a class="btn btn-danger writeCommentCancel">Cancel</a>
                                            <button type="submit" class="btn btn-primary">Comment</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <!-- END -->

                    </div>


                <?php endforeach; ?>

            <?php else : ?>
                <!-- there is no publications for this user -->
                <?php if (count($this->friendList) > 0) : ?>
                    <h1>None of your friends has publications yet, add more fiends!</h1>
                <?php else : ?>
                    <h1>You dont have any friends! look for someone</h1>
                <?php endif; ?>


            <?php endif; ?>

            <!-- END OF THE PUBLICATION ITERATION -->


        </main>
        <aside class="col-md-3 shadow bg-white rounded" id="aside">
            <!-- tittle -->
            <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
                <img class="mr-3" src="<?php echo constant('URL'); ?>public/images/friends.png" alt="" width="48" height="48">
                <div class="lh-100">
                    <h1 class="mb-0 text-dark lh-100">Friends</h6>
                </div>
            </div>
            <ul class="list-group mb-3">
                <button type="button" class="btn btn-outline-success btn-small" data-toggle="modal" data-target="#staticBackdrop">Add Friend</button>

                <?php foreach ($this->friendList as $key => $friend) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class=""><?php echo $friend->firstname . " " . $friend->lastname . "  <strong>@" . $friend->username . "</strong>"; ?></div>
                        <div class="d-flex justify-content-end">
                            <a href="<?php echo constant('URL') . '/friends/deleteFriend?id=' . $friend->id; ?>" type="button" class="btn btn-outline-danger btn-small">Delete</a>
                        </div>
                    </li>
                <?php endforeach; ?>


            </ul>
            <!-- ALERT MESSAGE -->
            <?php if ($this->addFriend !== "") : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $this->addFriend; ?>
                </div>
            <?php endif; ?>
        </aside>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add a New Friend</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo constant('URL') ?>friends/addFriend" method="POST">
                    <div class="modal-body">
                        <h6>To Add a new friend, please write its username</h6>
                        <input type="text" placeholder="username" name="username">
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-danger" data-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-success">Find</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- HERE ENDS YOUR PAGE -->

    <?php require 'views/layouts/footer.php' ?>
</body>

</html>