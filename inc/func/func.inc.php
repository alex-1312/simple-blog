<?php
// avoid file from beeing called directly via url
defined('SECURE') or die(header('location: index.php'));

/*
  format a datestring coming from database
  @param: $dbDate datestring from database
  @param: $format (optional) pattern for string encoding 
  @return: returns a utf8 encoded date string
*/

function formatDbDate($dbDate, $format = '%A, %d.%B.%Y %H:%M:%S')
{
  return utf8_encode(strftime($format, strtotime($dbDate)));
}

/*
  function to clean up user input
  @param: $userInput string
  @param: $encoding (optional) 
*/
function cleanInput($userInput, $encoding='UTF-8')
{
  return htmlspecialchars(
    strip_tags($userInput),
    ENT_QUOTES | ENT_HTML5,
    $encoding
  );
}

/*
  function to redirect to given url
*/
function redirect($url)
{
  header('location: ' . $url);
  exit;
}