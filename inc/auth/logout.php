<?php
define('SECURE',true);

require_once '../func/func.inc.php';

session_start();

// stop session
logOff();
$_SESSION['message'] = 'Logout.';

redirect('../../index.php');
session_destroy();