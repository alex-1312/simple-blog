<div class="container text-center pt-3">
  <h1>Registrierung</h1>
  <form action="inc/registration/register.php" method="post" class="needs-validation" novalidate>
    <!-- FIRSTNAME -->
    <div class="form-group">
      <label for="firstname">Vorname</label>
      <input type="text" class="form-control" pattern="[A-Za-z]{3,}" placeholder="Dein Vorname" id="firstname" name="firstname" required>
      <div class="valid-feedback">Ok.</div>
      <div class="invalid-feedback">Bitte füllen Sie dieses Feld aus. Mindestens 3 Buchstaben.</div>
    </div>
    <!-- LASTNAME -->
    <div class="form-group">
      <label for="lastname">Nachname</label>
      <input type="text" class="form-control" pattern="[A-Za-z]{3,}" placeholder="Dein Nachname" id="lastname" name="lastname" required>
      <div class="valid-feedback">Ok.</div>
      <div class="invalid-feedback">Bitte füllen Sie dieses Feld aus. Mindestens 3 Buchstaben.</div>
    </div>
    <!-- EMAIL -->
    <div class="form-group">
      <label for="email">E-Mail Adresse</label>
      <input type="email" class="form-control" pattern="^[A-Za-z]*[\._-]?[A-Za-z]*@{1}[A-Za-z]{2,}[\.]{1}[A-Za-z]{2,}[\.]?[A-Za-z]{0,}$" placeholder="mail@domain.de" id="email" name="email" required>
      <div class="valid-feedback">Ok.</div>
      <div class="invalid-feedback">Bitte füllen Sie dieses Feld mit einer gültigen E-Mail Adresse aus.</div>
    </div>
    <!-- PASSWORD -->
    <div class="form-group">
      <label for="password">Passwort</label>
      <input type="password" class="form-control" pattern="^.{8,}$" id="password" name="password" required>
      <div class="valid-feedback">Ok.</div>
      <div class="invalid-feedback">Bitte füllen Sie dieses Feld aus. Mindestens 8 Zeichen.</div>
    </div>
    <button type="submit" class="btn btn-primary">Abschicken</button>
  </form>
</div>
<script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>