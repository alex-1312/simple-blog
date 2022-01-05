<?php
// for development purposes only
// enable full error reporting
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

// requires 
require_once 'inc/db/db.inc.php';
require_once 'inc/func/func.inc.php';

// start session
session_start();

// set XSRF ( Cross-Site-Request-Forgery ) token
if(! isset($_SESSION['token'])) {
  $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
}

// TEST
// testSession();

// get login/error/success messages if available
if (isset($_SESSION['message'])) {
  // store notification in var 
  $message = $_SESSION['message'];
  // unset message from session, message should be shown only once
  unset($_SESSION['message']);
}

// get current page
$page = $_GET['page'] ?? '';

// class settings for info box
$info_box = $_GET['info_box'] ?? 'bg-info';

// include header
require_once 'inc/header.inc.php';

// switchcase navigation includes
switch($page)
{
  case 'blog': include 'inc/blog/blog.inc.php'; break;
  case 'blog_edit': include 'inc/blog/blog_edit.inc.php'; break;
  case 'register': include 'inc/registration/register.inc.php'; break;
  default: include 'inc/home/home.inc.php'; break;
}

// include footer
require_once 'inc/footer.inc.php';
?>