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

    <!-- HERE STARTS YOUR PAGE -->

    <div class="h-75">
        <div class="mt-5 mb-3">
            <h1>Itla Social Network</h1>
        </div>
        <div class="d-flex justify-content-center align-items-center h-75">
            <form class="form-signin" action="<?php echo constant('URL'); ?>signup/create" method="POST">
                <!-- ALERT MESSAGE -->
                <?php if ($this->message !== "") : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $this->message; ?>
                    </div>
                <?php endif; ?>
                <img class="mb-4" src="<?php echo constant('URL'); ?>public/images/login.png" alt="" width="72" height="72">
                <h1 class="h3 mb-3 font-weight-normal">Register Here</h1>
                <label for="firstname" class="sr-only">First Name</label>
                <input type="text" id="firstname" class="form-control" placeholder="First Name" required="" autofocus="" name="firstname">
                <label for="lastname" class="sr-only">Last Name</label>
                <input type="text" id="lastname" class="form-control" placeholder="Last Name" required="" autofocus="" name="lastname">
                <label for="email" class="sr-only">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Email" required="" autofocus="" name="email">
                <label for="phone" class="sr-only">Phone</label>
                <input type="tel" id="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" class="form-control" placeholder="Phone (809-555-5555)" required="" autofocus="" name="phone">
                <label for="username" class="sr-only">Username</label>
                <input type="text" id="username" class="form-control" placeholder="Username" required="" autofocus="" name="username">
                <!-- ALERT MESSAGE -->
                <?php if ($this->usernameMessage !== "") : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $this->usernameMessage; ?>
                    </div>
                <?php endif; ?>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" name="password">
                <label for="confirmPassword" class="sr-only">Confirm Password</label>
                <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm Password" required="" name="confirmPassword">
                <!-- ALERT MESSAGE -->
                <?php if ($this->passwordMessage !== "") : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $this->passwordMessage; ?>
                    </div>
                <?php endif; ?>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
                <br>
                <a href="<?php echo constant('URL'); ?>login"> Do you already have an account? Log in here!</a>
            </form>
        </div>


    </div>
    <!-- HERE ENDS YOUR PAGE -->

    <?php require 'views/layouts/footer.php' ?>
</body>

</html>