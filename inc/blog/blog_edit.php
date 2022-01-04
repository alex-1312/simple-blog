<?php
// for development purposes only
// enable full error reporting
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

// includes
require_once '../db/db.inc.php';
require_once '../func/func.inc.php';

// start session
session_start();

$_SESSION['message'] = 'Nachricht von blog_edit.php';
redirect('../../index.php?page=blog&info_box=bg-warning');