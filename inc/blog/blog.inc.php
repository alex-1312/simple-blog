<div class="container text-center pt-3">
  <h1>BLOG.INC.PHP</h1>

<?php if(isLoggedIn() && (isBlogUser() || isAdminUser())) : ?>
  <div class="rounded-lg bg-info">
  <p class="p-3">SICHTBAR FÜR BLOG USER ODER ADMIN.</p>
</div>

<form class="needs-validation" enctype="multipart/form-data" action="inc/blog/blog_insert.php" method="post" novalidate>
  <!-- ÜBERSCHRIFT -->
  <div class="form-group">
    <label for="title">Überschrift des Blogeintrages</label>
    <input type="text" class="form-control" name="title" id="title" placeholder="Blogüberschrift" required>
    <div class="valid-feedback">Ok.</div>
    <div class="invalid-feedback">Bitte füllen Sie dieses Feld aus.</div>
  </div>
  <!-- BLOG POST -->
  <div class="form-group">
    <label for="blogpost">Blog Eintrag</label>
    <textarea class="form-control" name="blogpost" id="blogpost" placeholder="Dein Blog Eintrag." required></textarea>
    <div class="valid-feedback">Ok.</div>
    <div class="invalid-feedback">Bitte füllen Sie dieses Feld aus.</div>
  </div>
  <div class="form-group">
    <label for="fileToUpload">Picture Upload</label>
    <input type="file" class="form-control-file border rounded-lg" name="fileToUpload" id="fileToUpload">
  </div>
  <input type="hidden" name="userid" value="<?= $_SESSION['id'] ?>">
  <input type="hidden" name="xsrf-token" value="<?= $_SESSION['token']; ?>">
  <button type="submit" class="btn btn-primary">Abschicken</button>
</form>
<?php endif; ?>


<?php
  // get database data
  $sql = 'SELECT * , blog_posts.created_at AS datum FROM blog_posts
          LEFT JOIN users
          ON  
            blog_posts.user_id = users.id
          ORDER BY
            blog_posts.created_at DESC';
  $statement = $db->query($sql);
  $data = $statement->fetchAll();
  
  // TEST
  echo '*************TEST****************';
  echo '<br>';
  var_dump($data);
  echo '<br>';
  echo '*************TEST****************';
  
?>

</div>

