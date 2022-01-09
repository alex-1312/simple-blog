<form class="needs-validation" action="inc/profile/profile_edit.php" method="post" novalidate>
            
  <!-- Firstname -->
  <div class="form-group">
    <label for="firstname">Vorname</label>
    <input  type="text" class="form-control" 
            pattern="[A-Za-z]{3,}" value="<?= $firstName; ?>" 
            id="firstname" name="firstname" required>
    <div class="valid-feedback">Ok.</div>
    <div class="invalid-feedback">
      Bitte füllen Sie dieses Feld aus. Mindestens 3 Buchstaben.
    </div>
  </div>

  <!-- Lastname-->
  <div class="form-group">
    <label for="lastname">Nachname</label>
    <input  type="text" class="form-control" 
            pattern="[A-Za-z]{3,}" value="<?= $lastName; ?>" 
            id="lastname" name="lastname" required>
    <div class="valid-feedback">Ok.</div>
    <div class="invalid-feedback">
      Bitte füllen Sie dieses Feld aus. Mindestens 3 Buchstaben.
    </div>
  </div>

  <!-- EMAIL -->
  <div class="form-group">
    <label for="email">E-Mail Adresse</label>
    <input  type="email" class="form-control" 
            pattern="^[A-Za-z]*[\._-]?[A-Za-z]*@{1}[A-Za-z]{2,}[\.]{1}[A-Za-z]{2,}[\.]?[A-Za-z]{0,}$" 
            value="<?= $eMail ?>" 
            id="email" name="email" required>
    <div class="valid-feedback">Ok.</div>
    <div class="invalid-feedback">
      Bitte füllen Sie dieses Feld mit einer gültigen E-Mail Adresse aus.
    </div>
  </div>

  <!-- PASSWORD -->
  <div class="form-group">
    <label for="password">Passwort</label>
    <input  type="password" class="form-control" 
            pattern="^.{8,}$" 
            id="password" name="password">
    <div class="valid-feedback">Ok.</div>
    <div class="invalid-feedback">
      Wenn Sie ihr Passwort ändern wollen, sollte dieses aus mindestens 8 Zeichen bestehen.
    </div>
  </div>

  <input type="hidden" name="xsrf-token" value="<?= $_SESSION['token']; ?>">

  <!-- Actionbuttons -->
  <div class="">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Zurück</button>
    <button type="submit" class="btn btn-primary">Abschicken</button>
  </div>

</form>