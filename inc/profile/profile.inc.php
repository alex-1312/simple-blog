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
$userId = (int)$user['id'];
$firstName = ucfirst(trim(cleanInput($user['firstname'])));
$lastName = ucfirst(trim(cleanInput($user['lastname'])));
$eMail = ucfirst(trim(cleanInput($user['email'])));
$role = ucfirst(trim(cleanInput($user['role'])));
$createdAt = formatDbDate($user['created_at']);
$updatedAt = (!empty($user['updated_at'])) ? $user['updated_at'] : '';

?>
<!-- Content container -->
<div class="container text-center">

  <!-- Heading -->
  <h1 class="text-muted py-3">Dein Benutzer Profil</h1>

  <!-- Card container -->
  <div class="card">

    <!-- Card header and user info -->
    <div class="card-header bold-p">
      <small class="text-muted">Vorname:</small>
      <p><?= $firstName; ?></p>
      <small class="text-muted">Nachname:</small>
      <p><?= $lastName; ?></p>
    </div>

    <!-- Card body and user info -->
    <div class="card-body">
      <small class="text-muted">Mail:</small>
      <p><?= $eMail; ?></p>
      <small class="text-muted">Benutzerrolle:</small>
      <p><?= $role; ?></p>
      <small class="text-muted">Konto erstellt:</small>
      <p><?= $createdAt; ?></p>
      <?php if(!empty($updatedAt)) : ?>
      <small class="text-muted">Konto zuletzt aktuallisiert:</small>
      <p><?= $updatedAt; ?></p>
      <?php endif; ?>
    </div>
    
    <!-- Card footer and actionbuttons -->
    <div class="card-footer d-flex justify-content-center">

      <!-- Button delete -->
      <div class="mx-1">
        <form action="inc/profile/profile_delete.php" method="post">
          <input type="hidden" name="user-id">
          <input type="hidden" name="xsrf-token">
          <input class="btn btn-danger" type="submit" value="Benutzerkonto löschen">
        </form>
      </div>

      <div class="mx-1"> 
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#profile-edit-form">
          Benutzerkonto bearbeiten
        </button>
      </div>

    </div>
  </div>

  <!-- The Modal -->
  <div class="modal" id="profile-edit-form">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Benutzerkonto bearbeiten</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body text-center">
          
          <?php require_once 'inc/profile/profile_edit_form.php'; ?>

        </div>
      </div>
    </div>
  </div>
</div>

<?php
test($user);
?>