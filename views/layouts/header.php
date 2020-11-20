<?php

$auth = new Auth();

?>

<div class="bg-dark d-flex justify-content-between">
    <div class="d-flex align-items-center">
        <h2 class="ml-3 text-white">Social App</h2>
    </div>
    <div>
        <ul class="d-flex justify-content-end align-items-center mb-0">
            <?php if ($auth->checkAuthentication()) : ?>
                <li class="p-3"><a class="text-white" href="#">
                        <span class="text-warning">
                            Welcome <?php echo $auth->retrieveUser()->firstname ?>
                        </span>
                    </a></li>
                <li class="p-3"><a class="text-white" href="<?php echo constant('URL'); ?>">Home</a></li>
                <li class="p-3"><a class="text-white" href="<?php echo constant('URL'); ?>friends">Friends</a></li>
                <li class="p-3"><a class="text-white" href="<?php echo constant('URL'); ?>logout">Logout</a></li>
            <?php else : ?>
                <li class="p-3"><a class="text-white" href="<?php echo constant('URL'); ?>">Home</a></li>
                <li class="p-3"><a class="text-white" href="<?php echo constant('URL'); ?>login">Login</a></li>
                <li class="p-3"><a class="text-white" href="<?php echo constant('URL'); ?>signup">Register</a></li>
            <?php endif; ?>

        </ul>
    </div>
</div>