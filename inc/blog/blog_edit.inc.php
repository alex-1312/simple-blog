<?php
if(
    (isAdminUser() || isBlogUser()) &&
    ((int)$_GET['user_id'] === (int)$_SESSION['id']) &&
    ($_GET['xsrf-token'] === $_SESSION['token'])
  )
{ 
  // vars
  $post_id = cleanInput($_GET['post_id']);
  $user_id = cleanInput($_GET['user_id']);
  $old_fname = cleanInput($_GET['fname']); 

  // sql query string
  $sql = 'SELECT * FROM blog_posts WHERE id = ?';
  // prepare and execute
  $statement = $db->prepare($sql);
  $statement->execute([$post_id]);
  // fetch data from database
  $data = $statement->fetch();
?>
<div class="container text-center pt-3">
  <h1>Blog Beitrag bearbeiten</h1>
  <div class="rounded-lg bg-info">
    <p class="p-3">Hallo <?= $_SESSION['username'] ;?>. Deine Freigabe: <?= ucfirst($_SESSION['role']); ?>. SICHTBAR FÜR DEN VERFASSER UND DEN ADMIN.</p>
    <p class="bg-danger"><?= $old_fname ?></p>
  </div>

  <?php if(!empty($old_fname)) : ?>
    <img class="img-33 my-3" src="image_upload/<?= $old_fname ?>" alt="">
  <?php endif; ?>

  <form class="needs-validation" enctype="multipart/form-data" action="inc/blog/blog_edit.php" method="post" novalidate>
    <!-- ÜBERSCHRIFT -->
    <div class="form-group">
      <label for="title">Überschrift des Blogeintrages</label>
      <input type="text" class="form-control" name="title" id="title" value="<?= cleanInput($data['title']); ?>" required>
      <div class="valid-feedback">Ok.</div>
      <div class="invalid-feedback">Bitte füllen Sie dieses Feld aus.</div>
    </div>
    <!-- BLOG POST -->
    <div class="form-group">
      <label for="blogpost">Blog Eintrag</label>
      <textarea class="form-control" name="blogpost" id="blogpost" rows="10" required>
        <?= cleanInput($data['post']); ?>
      </textarea>
      <div class="valid-feedback">Ok.</div>
      <div class="invalid-feedback">Bitte füllen Sie dieses Feld aus.</div>
    </div>
    <div class="form-group">
      <label for="fileToUpload">Picture Upload</label>
      <input type="file" class="form-control-file border rounded-lg" name="fileToUpload" id="fileToUpload">
    </div>

    <input type="hidden" name="post_id" value="<?= $post_id; ?>">
    <input type="hidden" name="user_id" value="<?= $user_id; ?>">
    <input type="hidden" name="old_fname" value="<?= $old_fname; ?>">
    <input type="hidden" name="xsrf-token" value="<?= $_SESSION['token']; ?>">

    <div class="pb-5">
      <a class="btn btn-info" href="index.php?page=blog">Zurück</a>
      <button type="submit" class="btn btn-danger">Abschicken</button>
    </div>
  </form>
</div>
<?php
}
else
{
  $_SESSION['message'] = 'Sie haben nicht die nötigen Rechte.';
  redirect('index.php?page=blog&info_box=bg-warning');
  exit;
}
// TEST
  
var_dump($_GET);
echo '<br>';
echo '<br>';
echo '<pre>';
var_dump($data);
echo '</pre>';
?>