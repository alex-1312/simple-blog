<?php
// rename file 
// params: $fn - orginal filename
// return: new filename or null
function renameUploadedImage( $fn )
{
  // do only if $fn isnt empty
  if ( !empty($fn) ) {
    // splitting old filename
    $fn_part = mb_split("\.", $fn);
    // $fn_part is now an array
    // getting the extension 
    $fn_extension = $fn_part[count($fn_part) - 1];
    $fn_e = mb_strtolower($fn_extension);
    // do if file extension is image related
    if ( $fn_e == 'jpg' || $fn_e == 'jpeg' || $fn_e == 'gif' || $fn_e == 'png' ) {
      // setting new filename
      $new_fn = 'blog_' . date('YmdHis') . '.' . $fn_extension;
      return $new_fn;
    } else {
      return;
    }    
  } else {
    return;
  }    
}

// validate uploaded file
// filesize , mimetype
// param: $_FILES['name_attribute']  
// return: bool
function checkImageUpload( $file )
{
  // if param isnt empty
  if ( !empty($file['name']) ) {

    // first lets check tmp files mime type
    // get mime
    $fn_temp = $file['tmp_name'];
    $fn_size = $file['size'];
    $mime = mime_content_type($fn_temp);
    // split mime @ /
    $mime_part = mb_split('\/', $mime);
    // get array index 0 
    // - $mime_part[0] = image f.Ex.
    // - $mime_part[1] = jpeg f.Ex.
    $file_type = $mime_part[0];
    
    if ( $file_type !== 'image' ) {
      return false;
    }
    // check filesize 
    elseif ( $fn_size > 10000000 ) {
      return false;
    }
    else {
      return true;
    }
  } else {
    return false;
  }
}