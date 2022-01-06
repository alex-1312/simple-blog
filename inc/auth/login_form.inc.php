<form action="inc/auth/login.php" method="post" class="needs-validation" novalidate>
	<!-- EMAIL -->
	<div class="form-group"> 
		<label for="mail">Mail Adresse</label>
		<input type="text" class="form-control" name="mail" id="mail"
			placeholder="Mail Adresse" required="required"	/>
		<div class="valid-feedback">Ok.</div>
		<div class="invalid-feedback">Bitte füllen Sie dieses Feld aus.</div>		
	</div>
	<!-- PASSWORD -->
	<div class="form-group">
		<label for="pwd">Passwort</label>
		<input type="password" class="form-control" name="pwd" id="pwd"  
			placeholder="Passwort" required="required"  />
		<div class="valid-feedback">Ok.</div>
		<div class="invalid-feedback">Bitte füllen Sie dieses Feld aus.</div>		
	</div>
	<input type="hidden" name="xsrf-token" value="<?= $_SESSION['token']?>" />
	<input class="btn btn-info" type="submit" value="Einloggen" />
</form>
