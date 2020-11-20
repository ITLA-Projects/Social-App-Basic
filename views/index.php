<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Home - Social Network</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/bootstrap.min.css" type="text/css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/default.css" type="text/css">

</head>

<body>
    <?php require 'views/layouts/header.php' ?>
    <div class="w-75 m-auto row" id="click">
        <main class="col-md-12">
            <!-- tittle -->
            <div class="d-flex align-items-center justify-content-between p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
                <div class="d-flex align-items-center">
                    <img class="mr-3" src="<?php echo constant('URL'); ?>public/images/publications.png" alt="" width="48" height="48">
                    <div class="lh-100">
                        <h1 class="mb-0 text-dark lh-100">Publications</h6>
                    </div>
                </div>

                <div class="d-flex justtify-content-end">
                    <button id="newPublication" type="button" class="btn btn-outline-success mx-1">+ New Publication</button>
                </div>
            </div>

            <!-- Body for a new publication -->
            <div id="newPublicationBody" class="my-3 p-3 bg-white rounded shadow-sm d-none">
                <form action="<?php echo constant('URL'); ?>main/newPublication" method="POST">
                    <!-- ALERT MESSAGE -->
                    <?php if ($this->newPublicationErr !== "") : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $this->newPublicationErr; ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="title">Title of the Publication</label>
                        <input type="text" class="form-control" id="title" name="title" />
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea class="form-control" id="body" name="body" rows="3"></textarea>
                    </div>
                    <div class="form-group text-right">
                        <a id="newPublicationCancel" class="btn btn-danger">Cancel</a>
                        <button type="submit" class="btn btn-primary">Share your Publication</button>
                    </div>
                </form>
            </div>
            <!-- end of the body -->


            <!-- EACH PUBLICATION ITERATION -->
            <?php if (count($this->publicationList) > 0) : ?>

                <?php foreach ($this->publicationList as $key => $publication) : ?>

                    <div class="my-3 p-3 bg-white rounded shadow-sm">
                        <div class="">
                            <div class="d-flex align-items-center justify-content-between">
                                <h2 class="border-bottom border-gray pb-2 mb-0"><?php echo $publication->title ?></h2>
                                <div class="d-flex justtify-content-end">
                                    <button type="button" class="btn btn-outline-warning mx-1 editPublicationButton">Edit</button>
                                    <a href="<?php echo constant('URL') . "main/deletePublication?id=" . $publication->id; ?>" class="btn btn-outline-danger mx-1 deletePublication">Delete</a>
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
                                    <form action="<?php echo constant('URL'); ?>main/newComment" method="POST">
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

                        <!-- Section if you want to edit a publication -->
                        <form method="POST" action="<?php echo constant('URL'); ?>main/editPublication" class="d-none">
                            <input type="hidden" id="id" name="id" value="<?php echo $publication->id; ?>">
                            <input type="hidden" id="owner" name="owner" value="<?php echo $publication->owner; ?>">
                            <div class="form-group">
                                <label for="title">Title of the Publication</label>
                                <input type="text" class="form-control" id="title" aria-describedby="Title" name="title" value="<?php echo $publication->title; ?>">
                            </div>
                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea type="text" class="form-control" id="body" name="body"><?php echo $publication->body; ?></textarea>
                            </div>
                            <div class="form-group text-right">
                                <a class="btn btn-danger cancelEditPublication">Cancel</a>
                                <button type="submit" class="btn btn-primary">Edit This Publication</button>
                                <small id="publicationHelp" class="form-text text-muted">The date of this publication will update if you accept the Edit</small>
                            </div>
                        </form>
                        <!-- End of the Edit Section -->

                        <!-- END -->

                    </div>


                <?php endforeach; ?>

            <?php else : ?>
                <!-- there is no publications for this user -->

                <h1>You dont have any publication, write something!</h1>

            <?php endif; ?>

            <!-- END OF THE PUBLICATION ITERATION -->


        </main>

    </div>



    <?php require 'views/layouts/footer.php' ?>
</body>

</html>