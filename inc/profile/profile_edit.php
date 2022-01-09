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

// xsrf token
$xsrfToken = (isset($_POST['xsrf-token'])) ? $_POST['xsrf-token'] : '';


// die/redirect on missing permissions
if(!isLoggedIn() && $xsrfToken === $_SESSION['token'])
{ 
  $_SESSION['message'] = 'Sie haben nicht die nötigen Rechte.';
  die(redirect('../../index.php?info_box=bg-warning'));
}

// vars
$firstName = ucfirst(strtolower(cleanInput(trim($_POST['firstname']))));
$lastName = ucfirst(strtolower(cleanInput(trim($_POST['lastname']))));

$userId = (int)$_SESSION['id'];
$updatedAt = date("Y-m-d H:i:s");

$password = (!empty($_POST['password'])) ? 
              password_hash($_POST['password'], PASSWORD_DEFAULT) : '';

// db update
if(empty($password))
{
  $sql = 'UPDATE users
            SET    
              firstname = ?,
              lastname = ?,
              updated_at = ?
          WHERE id = ?';

  $statement = $db->prepare($sql);
  $statement->execute([$firstName,$lastName,$updatedAt,$userId]);
} 
else
{
  $sql = 'UPDATE users
            SET
              firstname = ?,
              lastname = ?,
              password = ?,
              updated_at = ?
            WHERE id = ?';

  $statement = $db->prepare($sql);
  $statement->execute([$firstName,$lastName,$updatedAt,$userId]);
}

$_SESSION['message'] = 'Benutzerkonto erfolgreich geändert.';

redirect('../../index.php?page=profile');
