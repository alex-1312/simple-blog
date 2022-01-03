<?php
// includes
require_once '../db/db.inc.php';
require_once '../func/func.inc.php';

// start session
session_start();

if(!($_POST))
{
  $_SESSION['message'] = 'Fehler bei der registrierung';
  redirect('../../index.php?page=register');
}
else
{
  $firstname = trim(cleanInput($_POST['firstname']));
  $lastname = trim(cleanInput($_POST['lastname']));
  $email = trim(cleanInput($_POST['email']));
  // hash the pwd with bcrypt-algorithm
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  ################################################################
  // check if email is already in use
  $sqlUniqueMail = 'SELECT * FROM users WHERE email = ?';
  $statement = $db->prepare($sqlUniqueMail);
  $statement->execute([$email]);
  $user = $statement->fetch();
  
  if(!($user))
  {
    // mail unique
    $sql = 'INSERT INTO users(
              firstname,
              lastname,
              email,
              password)
            VALUES(?,?,?,?)';
    $statement = $db->prepare($sql);
    $statement->execute([$firstname,$lastname,$email,$password]);

    $_SESSION['message'] = 'Account erfolgreich erstellt. Loggen Sie sich bitte ein.';

    redirect('../../index.php');
  }
  else
  {
    // mail not unique - no database insert
    $_SESSION['message'] = 'Die E-Mail Adresse existiert bereits. Bitte verwenden Sie eine andere Adresse.';
    redirect('../../index.php?page=register');
  }
}
