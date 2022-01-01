<?php
// define constant to determine if scripts are called
// directly via or called via include
define('SECURE', true);

// requires 
require_once 'inc/db/db.inc.php';
require_once 'inc/func/func.inc.php';

// start session
session_start();

// set XSRF ( Cross-Site-Request-Forgery ) token
if(! isset($_SESSION['token'])) {
  $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
}

// get login/error/success messages if available
if (isset($_SESSION['message'])) {
  // store notification in var 
  $message = $_SESSION['message'];
  // unset message from session, message should be shown only once
  unset($_SESSION['message']);
}

// get current page
$page = $_GET['page'] ?? '';

// TODO:
// creating and coding header file
// including header file

// switchcase navigation includes

// creating and coding footer file

?>