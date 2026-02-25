<?php
require_once __DIR__ . '/dbconnection.php';

// Handle add-country POST (supports image URL, uploaded file saved to uploads/, or stored as BLOB)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
  $name = trim($_POST['name'] ?? '');
  $capital = trim($_POST['capital'] ?? '');
  $imageUrl = trim($_POST['image_url'] ?? '');
  $imageName = null;
  $blobData = null;

  if ($name !== '') {
    // Handle uploaded file if present
    if (!empty($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
      $tmp = $_FILES['image_file']['tmp_name'];
      $origName = basename($_FILES['image_file']['name']);
      $storeBlob = isset($_POST['store_blob']);
      if ($storeBlob) {
        $blobData = file_get_contents($tmp);
        // when storing as blob, ignore URL and name
        $imageUrl = null;
        $imageName = null;
      } else {
        // save file to uploads folder
        $uploadsDir = __DIR__ . '/uploads';
        if (!is_dir($uploadsDir)) mkdir($uploadsDir, 0755, true);
        $unique = time() . '_' . preg_replace('/[^A-Za-z0-9._-]/', '_', $origName);
        $dest = $uploadsDir . DIRECTORY_SEPARATOR . $unique;
        if (move_uploaded_file($tmp, $dest)) {
          $imageName = $unique;
          $imageUrl = null;
        }
      }
    }

    // Insert row, include image_name and image_blob columns
    $stmt = $mysqli->prepare('INSERT INTO countries (name, capital, image_url, image_name, image_blob) VALUES (?, ?, ?, ?, ?)');
    if ($stmt) {
      // bind: 4 strings then a blob
      $blobDummy = null;
      $stmt->bind_param('ssssb', $name, $capital, $imageUrl, $imageName, $blobDummy);
      if ($blobData !== null) {
        // send blob as long data (param index 4 is zero-based)
        $stmt->send_long_data(4, $blobData);
      }
      $stmt->execute();
      $stmt->close();
    }
  }

  header('Location: ' . $_SERVER['PHP_SELF']);
  exit;
}

$search = trim($_GET['q'] ?? '');
if ($search !== '') {
  $stmt = $mysqli->prepare('SELECT id, name, capital, image_url, image_name, image_blob FROM countries WHERE name LIKE ? ORDER BY id');
  $countries = [];
  if ($stmt) {
    $like = '%' . $search . '%';
    $stmt->bind_param('s', $like);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res) {
      $countries = $res->fetch_all(MYSQLI_ASSOC);
    }
    $stmt->close();
  }
} else {
  $res = $mysqli->query('SELECT id, name, capital, image_url, image_name, image_blob FROM countries ORDER BY id');
  $countries = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GOOGLE MAPS DAW - Countries Carousel</title>
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="carousel.css" rel="stylesheet" />
    <style>
      /* Darker carousel controls and increased spacing */
      .carousel-inner { border-radius: 6px; overflow: hidden; }
      .carousel-control-prev,
      .carousel-control-next {
        width: 64px;
        height: 64px;
        top: 50%;
        transform: translateY(-50%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 1;
        transition: background .15s ease, transform .12s ease;
       
      }
      .carousel-control-prev { left: 0.3rem; }
      .carousel-control-next { right: 0.3rem; }
      .carousel-control-prev:hover,
      .carousel-control-next:hover {
  
        transform: translateY(-50%) scale(1.04);
        
      }
      .carousel-control-prev-icon,
      .carousel-control-next-icon {
        width: 28px;
        height: 28px;
        background-size: 28px 28px;
        filter: invert(1) drop-shadow(0 1px 2px rgba(0,0,0,0.6));
      }
      /* Improve caption contrast */
      .carousel-caption h5, .carousel-caption p {
        text-shadow: 0 2px 6px rgba(0,0,0,0.6);
        color: #fff;
      }
      @media (max-width: 576px) {
        .carousel-control-prev, .carousel-control-next { width:48px; height:48px; }
        .carousel-control-prev { left: 1rem; }
        .carousel-control-next { right: 1rem; }
      }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2 fixed-top">
  <div class="container-fluid justify-content-center">
    <a class="navbar-brand mx-auto" href="#">Countries</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
      <form class="d-flex" method="get" id="searchForm">
        <input class="form-control me-2" id="searchInput" name="q" type="search" placeholder="Search country" aria-label="Search" value="<?= htmlspecialchars($search) ?>" />
        <button class="btn btn-outline-success" type="submit">Search</button>
        <button class="btn btn-outline-secondary ms-2" type="button" id="clearSearch">Clear</button>
      </form>

      <!-- <form class="d-flex" method="post" enctype="multipart/form-data" style="gap:.5rem;" autocomplete="off">
        <input type="hidden" name="action" value="add">
        <input class="form-control" name="name" placeholder="Country" required>
        <input class="form-control" name="capital" placeholder="Capital">
        <input class="form-control" name="image_url" placeholder="Image URL (optional)">
        <input class="form-control" type="file" name="image_file" accept="image/*">
        <div class="form-check" style="align-self:center;">
          <input class="form-check-input" type="checkbox" value="1" id="storeBlob" name="store_blob">
          <label class="form-check-label text-white" for="storeBlob">Store as BLOB</label>
        </div>
        <button class="btn btn-success" type="submit">Add</button>
      </form> -->
    </div>
  </div>
</nav>

<div class="container" style="padding-top:6rem;">

<?php if (count($countries) === 0): ?>
  <div class="alert alert-warning">No countries found.</div>
<?php else: ?>

  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <?php foreach ($countries as $i => $c): ?>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="<?= $i ?>" <?php if ($i === 0) echo 'class="active"'; ?> aria-label="Slide <?= $i+1 ?>"></button>
      <?php endforeach; ?>
    </div>

    <div class="carousel-inner">
      <?php foreach ($countries as $i => $c): ?>
        <div class="carousel-item <?php if ($i === 0) echo 'active'; ?>">
          <?php
            $src = '';
            if (!empty($c['image_blob'])) {
              $src = 'data:image/*;base64,' . base64_encode($c['image_blob']);
            } elseif (!empty($c['image_url'])) {
              $src = $c['image_url'];
            } elseif (!empty($c['image_name']) && file_exists(__DIR__ . '/uploads/' . $c['image_name'])) {
              $src = 'uploads/' . $c['image_name'];
            } else {
              $src = 'https://via.placeholder.com/1200x400?text=No+Image';
            }
          ?>
          <img src="<?= htmlspecialchars($src) ?>" class="d-block w-100" style="max-height:450px; object-fit:cover;">
          <div class="container">
            <div class="carousel-caption text-center">
              <h5><?= htmlspecialchars($c['name']) ?></h5>
              <p>Capital: <?= htmlspecialchars($c['capital']) ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true" ></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

<?php endif; ?>

</div>

<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var clearBtn = document.getElementById('clearSearch');
  if (clearBtn) {
    clearBtn.addEventListener('click', function() {
      // clear query param and reload to show full carousel
      window.location = window.location.pathname;
    });
  }

  // If a search was used, focus carousel to first slide and scroll into view
  <?php if ($search !== ''): ?>
    var el = document.getElementById('myCarousel');
    if (el) {
      var carousel = bootstrap.Carousel.getInstance(el) || new bootstrap.Carousel(el);
      try { carousel.to(0); } catch(e) {}
      el.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  <?php endif; ?>
});
</script>
</body>
</html>