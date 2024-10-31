<?php
require '../controller/koneksi.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $sql = "SELECT * FROM post WHERE id='$id'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $article = $result->fetch_assoc();
  } else {
    echo "Artikel tidak ditemukan.";
    exit;
  }
} else {
  echo "ID tidak valid.";
  exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Edit Artikel - Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  </style>
</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="index.php">Kanisius Yossa</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
        class="fas fa-bars"></i></button>
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
      <div class="input-group">
        <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
          aria-describedby="btnNavbarSearch" />
        <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
      </div>
    </form>
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
          aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="#!">Settings</a></li>
          <li><a class="dropdown-item" href="#!">Activity</a></li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li><a class="dropdown-item" href="#!">Logout</a></li>
        </ul>
      </li>
    </ul>
  </nav>

  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading">menu</div>
            <a class="nav-link" href="index.php">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Dashboard
            </a>
          </div>
        </div>
        <div class="sb-sidenav-footer">
          <div class="small">Logged in as:</div>
          Start Bootstrap
        </div>
      </nav>
    </div>

    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">Artikel</h1>
          <ol class="breadcrumb mb-4">
            <a href="index.php" class="btn btn-primary ms-3">Kembali</a>
          </ol>
          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-pen me-1"></i>
              Ubah Artikel
            </div>
            <div class="card-body">
              <form action="../controller/update.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $article['id']; ?>">

                <!-- Hidden input for current image -->
                <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($article['image']); ?>">

                <div class="input-group flex-nowrap mb-3">
                  <input type="text" class="form-control" placeholder="Judul" aria-label="judul" name="judul"
                    value="<?php echo htmlspecialchars($article['judul']); ?>" required>
                </div>

                <!-- Change kategori input to select -->
                <div class="mb-3">
                  <select class="form-select" name="kategori" id="kategori" required>
                    <option value="Lifestyle Post" <?php echo ($article['kategori'] === 'Lifestyle Post') ? 'selected' : ''; ?>>Lifestyle Post</option>
                    <option value="Technology Posts" <?php echo ($article['kategori'] === 'Technology Posts') ? 'selected' : ''; ?>>Technology Posts</option>
                  </select>
                </div>


                <div class="input-group flex-nowrap mb-3">
                  <input type="text" class="form-control" placeholder="Author" aria-label="author" name="author"
                    value="<?php echo htmlspecialchars($article['author']); ?>" required>
                </div>

                <div class="form-floating mb-3">
                  <textarea class="form-control" placeholder="Isi Artikel" id="floatingTextarea" name="deskripsi"
                    required><?php echo htmlspecialchars($article['deskripsi']); ?></textarea>
                  <label for="floatingTextarea">Isi Artikel</label>
                </div>
                <div class="input-group flex-nowrap mb-3">
                  <input type="file" class="form-control" placeholder="Gambar" aria-label="gambar" name="image"
                    accept="image/*">
                  <!-- <label class="input-group-text" for="image">Upload</label> -->
                </div>
                <div class="input-group flex-nowrap mb-3">
                  <button type="submit" class="btn btn-primary ms-3">Ubah</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </main>
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website 2023</div>
            <div>
              <a href="#">Privacy Policy</a>
              &middot;
              <a href="#">Terms &amp; Conditions</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
</body>

</html>