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

if( (empty($_GET)) ||
    (
      (!isAdminUser() || !isBlogUser()) &&
      ((int)$_GET['user_id'] !== (int)$_SESSION['id']) &&
      ($_GET['xsrf-token'] !== $_SESSION['token'])
    )
  )
{
  $_SESSION['message'] = 'Sie haben nicht die nötigen Rechte.';
  die(redirect('../../index.php?page=blog&info_box=bg-warning'));
}  
// vars
$post_id = $_GET['post_id'];
// if fname is not empty asign its value to $fn
$fn = (!empty($_GET['fname'] ) ? $_GET['fname'] : '' );
$path = '../../image_upload/' . $fn;

$sql = 'DELETE FROM blog_posts WHERE id = ?';
$statement = $db->prepare($sql);
$statement->execute([$post_id]);

// if file exists delete it on webserv
if(file_exists($path))
{ 
  $msg = ' Bilddatei: ' . $fn . ' wurde gelöscht.';
  unlink($path);
}
else
{
  $msg = '';
}

$_SESSION['message'] = 'Blog Beitrag wurde gelöscht.' . $msg;
redirect('../../index.php?page=blog&info_box=bg-warning');
   

 

  



