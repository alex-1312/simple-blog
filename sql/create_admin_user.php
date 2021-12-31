<?php
require_once '../inc/db/db.inc.php';

$fn = 'Alex';
$ln = 'R';
$pwd = password_hash('admin', PASSWORD_DEFAULT);
$mail = 'test@test.de';
$role = 'admin';

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
  echo 'ADMIN USER CREATED';
  }else{
  echo 'FAILED TO CREATE ADMIN USER';
  }
}else{
  echo 'EMAIL ALREADY REGISTERED';
}

