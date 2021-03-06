<?php
// for development purposes only
// enable full error reporting
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

require_once '../db/db.inc.php';
require_once '../func/func.inc.php';

// // start session
session_start();

$mail = trim($_POST['mail']);
$pwd = trim($_POST['pwd']);

if( !empty($_POST) && $_POST['xsrf-token'] === $_SESSION['token'])
{
	$sql = 'SELECT * FROM users WHERE email = ?';
	$statement = $db->prepare($sql);
	$statement->execute([$mail]);
	$user = $statement->fetch();
	var_dump($user);		

	if($user && password_verify($pwd, $user['password']))
	{
		logIn($user['email'], $user['firstname'], $user['id'], $user['role']);			
		$_SESSION['message'] = 'Willkommen ' . $user['firstname'];
	} 
	else
	{
		$_SESSION['message'] = 'Fehler beim Einloggen.';			 
		redirect('../../index.php?info_box=bg-danger');
	}		
}
redirect('../../index.php?info_box=bg-success');