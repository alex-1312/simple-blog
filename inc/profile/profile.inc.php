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
<div class="container text-center">
  <h1 class="text-muted py-3">Dein Benutzer Profil</h1>
  <div class="card">
    <div class="card-header bold-p">
      <small class="text-muted">Vorname:</small>
      <p><?= $firstName; ?></p>
      <small class="text-muted">Nachname:</small>
      <p><?= $lastName; ?></p>
    </div>
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
    <div class="card-footer">
      <form action="inc/profile/profile_delete.php" method="post">
        <input type="hidden" name="user-id">
        <input type="hidden" name="xsrf-token">
        <input class="btn btn-danger" type="submit" value="Benutzerkonto löschen">
      </form>
      <form action="inc/profile/profile_edit_form.php" method="post">
        <input type="hidden" name="user-id" value="<?= $userId; ?>">
        <input type="hidden" name="xsrf-token" value="<?= $_SESSION['token']; ?>">
        <input class="btn btn-primary" type="submit" value="Benutzerkonto bearbeiten">
      </form>
    </div>
  </div>
</div>

<?php
test($user);
?>