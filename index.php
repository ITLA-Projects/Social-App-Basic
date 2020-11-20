<?php

/**
 * STRUCTURE OF THE PROJECT - MIGUEL ANGEL - 2018-6717
 */

//load database
require_once 'libs/database.php';
require_once 'libs/utilities.php';

//time zone
date_default_timezone_set("America/Santo_Domingo");

//load models
require_once 'models/user.php';
require_once 'models/publication.php';
require_once 'models/comment.php';
require_once 'models/friend.php';

//load libs & repos
require_once 'libs/IRepository.php';
require_once 'libs/repository.php';
require_once 'repositories/publicationRepository.php';
require_once 'repositories/commentRepository.php';
require_once 'repositories/friendRepository.php';
require_once 'repositories/userRepository.php';
require_once 'libs/auth.php';
require_once 'libs/controller.php';
require_once 'libs/view.php';
require_once 'libs/model.php';
require_once 'libs/app.php';

//load config
require_once 'config/config.php';

//load session
session_start();

//load app
$app = new App();

?>