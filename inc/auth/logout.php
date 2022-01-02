<?php
require_once '../func/func.inc.php';

session_start();
$un = $_SESSION['username'];
// stop session
logOff();
$_SESSION['message'] = 'Auf Wiedersehen ' . $un;

redirect('../../index.php');
session_destroy();