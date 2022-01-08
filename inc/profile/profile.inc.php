<?php

// die/redirect on missing permissions
if(!isLoggedIn())
{ 
  $_SESSION['message'] = 'Sie haben nicht die nötigen Rechte.';
  die(redirect('index.php?info_box=bg-warning'));
}

// sql string
$sql = 'SELECT * FROM users WHERE id = ?';

// get user data
$statement = $db->prepare($sql);
$statement->execute([$_SESSION['id']]);
$user = $statement->fetch();

// user vars
$firstName = ucfirst(trim(cleanInput($user['firstname'])));
$lastName = ucfirst(trim(cleanInput($user['lastname'])));
$eMail = ucfirst(trim(cleanInput($user['email'])));
$role = ucfirst(trim(cleanInput($user['role'])));
$createdAt = formatDbDate($user['created_at']);
$updatedAt = (!empty($user['updated_at'])) ? $user['updated_at'] : '';

?>
<div class="container text-center">
  <h1 class="text-muted py-3">Dein Benutzer Profil</h1>
  <div class="card">
    <div class="card-header bold-p">
      <small class="text-muted">Vorname:</small>
      <p><?= $firstName; ?></p>
      <small class="text-muted">Nachname:</small>
      <p><?= $lastName; ?></p>
    </div>
    <div class="card-body">Content</div>
    <div class="card-footer">Footer</div>
  </div>
</div>

<?php
test($user);
?>