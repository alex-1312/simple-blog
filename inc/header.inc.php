<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= !empty($page) ? ucfirst($page) : 'Home'?></title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> 
  
  <!-- From Validation -->
  <script src="js/validate.js" defer></script>

  <!-- STYLES -->
  <style>
    <?= require 'css/style.css'; ?>
  </style>
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-md bg-light navbar-light">
  <!-- Brand -->
  <!-- <a class="navbar-brand" href="#">Small Blog</a> -->

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item <?= empty($page) ? 'active' : '';  ?>">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item <?= ($page == 'blog') ? 'active' : ''; ?>">
        <a class="nav-link" href="index.php?page=blog">Blog</a>
      </li>
      <?php if(!isLoggedIn()) :?>
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" href="#modal-login-form">Login</a>
      </li>
      <?php else : ?>
        <li class="nav-item">
        <a class="nav-link" href="inc/auth/logout.php">Logout</a>
      </li>
      <?php endif; ?>
    </ul>
  </div>
</nav> 
<?php
  if(!isLoggedIn()){
    require_once 'inc/auth/modal_login_form.inc.php';
  }
?>
<?php if (isset($message)) : ?>
  <div class="<?= $info_box ?> text-center sticky-top">
    <p class="text-white p-1">
      <b><?= $message ?></b>
    </p>
  </div>
<?php endif; ?>