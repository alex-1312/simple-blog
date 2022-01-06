<!-- The Modal -->
<div class="modal fade" id="modal-login-form">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Einloggen oder Registrieren</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body text-center">
        <?php
          require_once 'inc/auth/login_form.inc.php';
        ?>
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <a class="btn btn-primary" href="index.php?page=register">Registrieren</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>