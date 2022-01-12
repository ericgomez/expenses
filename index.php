<?php

require_once('libs/database.php');
require_once('classes/errormessages.php');
require_once('classes/successmessages.php');

require_once('libs/controller.php');
require_once('libs/model.php');
require_once('libs/view.php');
require_once('libs/app.php');
// session controller required of the views
require_once('classes/sessioncontroller.php');

require_once('config/config.php');

include_once 'models/usermodel.php';
include_once 'models/expensesmodel.php';
include_once "models/categoriesmodel.php";
include_once "models/joinexpensescategoriesmodel.php";

$app = new App();
