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

//check permissions
if(!isLoggedIn() && (!isBlogUser() || !isAdminUser()))
{
  $_SESSION['message'] = 'Kein Zugriff.';
  redirect('../../index.php?info_box=bg-danger');
  exit;
}

if(!($_POST))
{
  $_SESSION['message'] = 'Fehler beim Absenden des Formulars';
  redirect('../../index.php?page=blog&info_box=bg-warning');
}
elseif($_POST['xsrf-token']===$_SESSION['token'])
{
  $id = $_SESSION['id'];
  $title = trim(cleanInput($_SESSION['title']));
  $blogpost = trim(cleanInput($_SESSION['blogpost']));
  
  $new_fn;

  // handle possible fileupload
  if ( !empty($_FILES['fileToUpload']['name']) ) {
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
    }
  } 

  // the database insert
  // sql string
  $sql = 'INSERT INTO blog_posts(
            user_id,
            title,
            post,
            img_file_name
          )
          VALUES(?,?,?,?)';

  $statement = $db->prepare($sql);
  $statement->execute([$id,$title,$blogpost,$new_fn]);

  $_SESSION['message'] = 'Blog Eintrag übermittelt.';
}
// redirect('../../index.php?page=blog');