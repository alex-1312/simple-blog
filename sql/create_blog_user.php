<?php
require_once '../inc/db/db.inc.php';

$fn = 'John';
$ln = 'Doe';
$pwd = password_hash('12345678', PASSWORD_DEFAULT);
$mail = 'bloguser@test.de';
$role = 'blog_user';

//check if user is already registered
$uniqueMail = 'SELECT * FROM users WHERE email = ?';
$statement = $db->prepare($uniqueMail);
$statement->execute([$mail]);
$user = $statement->fetch();

if(!($user)){
  // email record not in db yet insert posible
  // sql query
  $sql = 'INSERT INTO users(
    firstname,
    lastname,
    password,
    email,
    role)
  VALUES(?,?,?,?,?)';

  // prepare statement
  $stmt = $db->prepare($sql);
  // execute statement
  if($stmt->execute([$fn,$ln,$pwd,$mail,$role])){
  echo 'BLOG USER CREATED';
  }else{
  echo 'FAILED TO CREATE BLOG USER';
  }
}else{
  echo 'EMAIL ALREADY REGISTERED';
}