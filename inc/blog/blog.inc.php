<?php
  /**TODO:
   * Dynamic pagination limit form
   */

  // pagination vars
  // dynamic limit
  $limit = isset($_SESSION['rec-limit']) ? $_SESSION['rec-limit'] : 5;

  // get total records
  $sql = $db->query('SELECT COUNT(id) AS id FROM blog_posts')->fetchAll();
  $allRecords = $sql[0]['id'];

  // calculate total pages
  $totalPages = ceil($allRecords / $limit);

  // current pagination number
  $pageNumber = (isset($_GET['pn']) && is_numeric($_GET['pn']) ? $_GET['pn'] : 1 );

  // offset
  $paginationStart =($pageNumber - 1) * $limit;

  // prev and next
  $prev = $pageNumber - 1;
  $next = $pageNumber + 1;
  
  // limit query 
  $data = $db->query(
             "SELECT * , blog_posts.created_at AS datum FROM blog_posts
              LEFT JOIN users
              ON  
                blog_posts.user_id = users.id
              ORDER BY
                blog_posts.created_at DESC
              LIMIT $paginationStart, $limit"
              )->fetchAll();
?>
<!-- BLOG CONTAINER -->
<div class="container text-center pt-3">
  <h1 class="text-muted">BLOG.INC.PHP</h1>
<?php foreach($data AS $key=>$value) : ?>
  <div class="rounded-lg border bg-light text-dark my-5 py-3">
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
  </div>
<?php endforeach; ?>


<!-- PAGINATION -->
<ul class="pagination justify-content-center">
  <li class="page-item <?php if($pageNumber <= 1){echo 'disabled';} ?>">
    <a class="page-link"
      href="<?php if($pageNumber <= 1){echo 'index.php?page=blog';} else {echo 'index.php?page=blog&pn=' . $prev; } ?>">vorherige</a>
  </li>
  <?php for($i = 1; $i <= $totalPages; $i++) : ?>
    <li class="page-item <?php if($pageNumber == $i) {echo 'active'; } ?>">
      <a class="page-link" href="index.php?page=blog&pn=<?= $i; ?>"> <?= $i; ?> </a>
    </li>
  <?php endfor; ?>
  <li class="page-item <?php if($pageNumber >= $totalPages) { echo 'disabled'; } ?>">
    <a class="page-link"
      href="<?php if($pageNumber >= $totalPages){ echo 'index.php?page=blog&pn=' . $totalPages; } else {echo "index.php?page=blog&pn=" . $next; } ?>">nächste</a>
  </li>
</ul>

<!-- NEW BLOG ENTRIES -->
<?php if(isLoggedIn() && (isBlogUser() || isAdminUser())) : ?>
  <h3 class="pt-3 text-dark">Erstellen neuer Blogbeiträge</h3>
  <div class="rounded-lg bg-info">
  <p class="p-1">Hallo <?= $_SESSION['username'] ;?>. Deine Freigabe: <?= ucfirst($_SESSION['role']); ?>.</p>
</div>

<form class="needs-validation pb-3" enctype="multipart/form-data" action="inc/blog/blog_insert.php" method="post" novalidate>
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
    <label for="fileToUpload">Bild Upload</label>
    <input type="file" class="form-control-file border rounded-lg" name="fileToUpload" id="fileToUpload">
  </div>
  <input type="hidden" name="userid" value="<?= $_SESSION['id'] ?>">
  <input type="hidden" name="xsrf-token" value="<?= $_SESSION['token']; ?>">
  <button type="submit" class="btn btn-primary">Abschicken</button>
</form>
<?php endif; ?>

</div>



