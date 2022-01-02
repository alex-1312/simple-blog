<?php
// avoid file from beeing called directly via url
defined('SECURE') or die('ZUGRIFF VERWEIGERT: ' . __FILE__);

/**
 * format a datestring coming from database
 * @param: $dbDate datestring from database
 * @param: $format (optional) pattern for string encoding 
 * @return: returns a utf8 encoded date string
*/
function formatDbDate($dbDate, $format = '%A, %d.%B.%Y %H:%M:%S')
{
  return utf8_encode(strftime($format, strtotime($dbDate)));
}

/**
 * function to clean up user input
 * @param: $userInput string
 * @param: $encoding (optional)
 */
function cleanInput($userInput, $encoding='UTF-8')
{
  return htmlspecialchars(
    strip_tags($userInput),
    ENT_QUOTES | ENT_HTML5,
    $encoding
  );
}
/**
 * function to redirect to given url 
 * @param: $url - url to redirect to
 */
function redirect($url)
{
  header('location: ' . $url);
  exit;
}

/**
 * function to determine if user is logged in 
 * @return: bool 
 */
function isLoggedIn()
{
    return isset($_SESSION['logged']);
}

/**
 * function to determine if user has blog_user rights
 * @return: bool 
 */
function isBlogUser()
{
  if(isset($_SESSION['logged']) && $_SESSION['role'] === 'blog_user'){
    return true;
  }else{
    return false;
  }
}

/**
 * function to determine if user has admin user rights
 * @return: bool 
 */
function isAdminUser()
{
  if(isset($_SESSION['logged']) && $_SESSION['role'] === 'admin'){
    return true;
  }else{
    return false;
  }
}

/**
 * function to log user in i.e. set the session vars
 * @param: $mail - string
 * @param: $username - string
 * @param: $id - string
 * @param: $role - string 
 */
function logIn($mail, $username, $id, $role)
{
  $_SESSION['logged'] = $mail;
  $_SESSION['username'] = $username;
  $_SESSION['id'] = $id;
  $_SESSION['role'] = $role;
}

/**
 * function to log off the user i.e. unset the session vars
 */
function logOff()
{
  unset($_SESSION['logged']);
  unset($_SESSION['username']);
  unset($_SESSION['id']);
  unset($_SESSION['role']);
  unset($_SESSION['token']);
}