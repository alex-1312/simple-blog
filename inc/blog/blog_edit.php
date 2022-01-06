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



if( (empty($_POST)) &&
    (
      ((!isAdminUser()) || ((!isBlogUser()) && ((int)$_POST['user_id'] !== (int)$_SESSION['id']))) &&
      ($_POST['xsrf-token'] !== $_SESSION['token'])
    )
  )
{ 
  $_SESSION['message'] = 'Sie haben nicht die nötigen Rechte.';
  die(redirect('../../index.php?page=blog&info_box=bg-warning'));
}

// vars
$title = trim(cleanInput($_POST['title']));
$blogpost = trim(cleanInput($_POST['blogpost']));
$post_id = (int)$_POST['post_id'];
$old_fname = $_POST['old_fname'];
$upload_status = '';
$new_fn = '';
$datetime = date("Y-m-d H:i:s");

// handle the blog_post image
// if database does NOT contain an image file name
// and user want to upload a whole new image file 
if ( empty($old_fname) && !empty($_FILES['fileToUpload']['name']) ) {
  $f = $_FILES['fileToUpload'];
  $fn = $_FILES['fileToUpload']['name'];
  $fn_temp = $_FILES['fileToUpload']['tmp_name'];
  // inc/func/func_upload.inc.php
  $new_fn = renameUploadedImage( $fn );
  // inc/func/func_upload.inc.php
  // if upload is OK move the image
  // from tmp to upload folder
  if ( checkImageUpload( $f ) ) {
      move_uploaded_file( $fn_temp, '../../image_upload/' . $new_fn );
      $upload_status = 'Upload OK. ';
  } else {
      $upload_status = 'Upload fehlgeschlagen.';
  } 
}

// if database already contains an image file name
// and user want to upload a whole new image file 
if ( !empty($old_fname) && !empty($_FILES['fileToUpload']['name']) ) {
  // first: delete old image file on webserver if exists
  $path = '../../image_upload/' . $old_fname;
  if ( file_exists($path) ) {
      unlink($path);
  }
  // now: rename uploaded file 
  //      check uploaded file (mime type and size)
  //      copy from temp to webserver
  $f = $_FILES['fileToUpload'];
  $fn = $_FILES['fileToUpload']['name'];
  $fn_temp = $_FILES['fileToUpload']['tmp_name'];
  // inc/func/func_upload.inc.php
  $new_fn = renameUploadedImage( $fn );            
  // inc/func/func_upload.inc.php
  // if upload is OK move the image
  // from tmp to upload folder
  if ( checkImageUpload( $f ) ) {
      move_uploaded_file( $fn_temp, '../../image_upload/' . $new_fn );
      $upload_status = 'Upload OK. ';
  } else {
      $upload_status = 'Upload failed. ';
  } 
}

//
if ( !empty($old_fname) && empty($_FILES['fileToUpload']['name']) ) {
  $new_fn = $old_fname;
}

// update database entries
// sql query string
$sql = 'UPDATE blog_posts
          SET
            title = ? ,
            post = ? ,
            img_file_name = ?,
            updated_at = ?
          WHERE
            id = ?
        ';
// prepare db
$statement = $db->prepare($sql);
// execute the statement
$statement->execute([$title, $blogpost, $new_fn, $datetime, $post_id]);

$_SESSION['message'] = 'Blog Eintrag geändert. ' . $upload_status;
redirect('../../index.php?page=blog&info_box=bg-info');

// TEST
// echo '<hr><pre>';
// var_dump($_POST);
// echo '<pre>';
// echo '<hr><pre>';
// var_dump($_FILES['fileToUpload']['name']);
// echo '<pre>';
