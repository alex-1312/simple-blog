<div class="container text-center pt-3">
  <h1>BLOG.INC.PHP</h1>

<?php if(isLoggedIn() && (isBlogUser() || isAdminUser())) : ?>
  <div class="rounded-lg bg-info">
  <p class="p-1">Hallo <?= $_SESSION['username'] ;?>. Deine Freigabe: <?= ucfirst($_SESSION['role']); ?>.</p>
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
    <textarea class="form-control" name="blogpost" id="blogpost" rows="10" placeholder="Dein Blog Eintrag." required></textarea>
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

foreach($data AS $key=>$value) : ?>
  <div class="rounded-lg bg-secondary text-white my-5 py-3">
    <section>
      <h3><?= cleanInput($value['title']); ?></h3>
      <p><small>Beitrag erstellt von</small> <b><?= ucfirst($value['firstname']); ?></b> <small>am</small> <b><?= formatDbDate($value['datum']); ?></b></p>
      <div class="clearfix p-3">
        <?php if(!empty($value['img_file_name']) && ($key % 2 === 0)) : ?>
          <img class="float-left img-33 px-1" src="image_upload/<?= $value['img_file_name']; ?>" alt="">
        <?php else : ?>
          <img class="float-right img-33 px-1" src="image_upload/<?= $value['img_file_name']; ?>" alt="">
        <?php endif; ?>
        <p class="text-left px-1">
          <?= nl2br(cleanInput($value['post'])); ?>
        </p>
      </div>
    </section>
  </div>
  <?php if(isset($_SESSION['id'])) : ?>
    <?php if (isAdminUser() || (isBlogUser() && $value['user_id'] === $_SESSION['id'])) : ?>
      <div class="pb-5">
        <a href="inc/blog/blog_delete.php?user_id=<?= (int)$value['user_id']; ?>&post_id=<?= (int)$value[0] ?>&fname=<?= $value['img_file_name']; ?>&xsrf-token=<?= $_SESSION['token']; ?>" onclick="return confirm('Delete? Really??');" class="btn btn-danger">
          Beitrag löschen
        </a>
        <a href="index.php?page=blog_edit&user_id=<?= (int)$value['user_id']; ?>&post_id=<?= (int)$value[0] ?>&fname=<?= $value['img_file_name']; ?>&xsrf-token=<?= $_SESSION['token']; ?>" class="btn btn-primary">
          Bearbeiten
        </a>
      </div>
    <?php endif; ?>
  <?php endif; ?>
<?php endforeach; ?>
</div>


