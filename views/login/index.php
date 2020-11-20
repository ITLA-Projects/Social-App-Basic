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

<body class="text-center">
    <?php require 'views/layouts/header.php' ?>

    <div class="h-75">
        <div class="mt-5 mb-3">
            <h1>Itla Social Network</h1>
        </div>
        <!-- LOGIN FORM -->
        <div class="d-flex justify-content-center align-items-center h-75">
            <form class="form-signin" action="<?php echo constant('URL'); ?>login/try" method="POST">
                <img class="mb-4" src="<?php echo constant('URL'); ?>public/images/login.png" alt="" width="72" height="72">
                <h1 class="h3 mb-3 font-weight-normal">Please Log in first</h1>

                <!-- ALERT MESSAGE -->
                <?php if ($this->logginMessage !== "") : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $this->logginMessage; ?>
                    </div>
                <?php endif; ?>

                <label for="username" class="sr-only">Username</label>
                <input type="text" id="username" class="form-control" placeholder="Username" required="" autofocus="" name="username">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" name="password">

                <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
                <br>
                <a href="<?php echo constant('URL'); ?>signup"> Dont have an account yet? Register here!</a>
            </form>
        </div>


    </div>


    <?php require 'views/layouts/footer.php' ?>
</body>

</html>