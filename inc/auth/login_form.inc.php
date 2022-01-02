<form action="inc/auth/login.php" method="post"> 
	<input type="text" name="mail" 
			placeholder="Insert Mail Address" required="required"	/>
			
	<input type="password" name="pwd" 
			placeholder="Password" required="required"  />
	
	<input type="hidden" name="csrf-token" value="<?= $_SESSION['token']?>" />
	<input type="submit" value="login" />
</form>
<div class="text-left">
  <a class="" href="index.php?page=register">Register</a>
</div>