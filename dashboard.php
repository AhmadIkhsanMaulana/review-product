<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Zero configuration -->
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
    <title>Dashboard</title>
  </head>
  <body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #DCDCDC;">
    <div class="container">
      <div class="mt-1">
        <a class="navbar-brand" href="dashboard.php">
          <svg xmlns="http://www.w3.org/2000/svg" style="width: 40px; height: 40px; color: #4169E1;" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
          </svg>
          <span>Review Product</span> 
        </a>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Inputan
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="?menu=user">User</a></li>
              <li><a class="dropdown-item" href="?menu=jenis">Jenis</a></li>
              <li><a class="dropdown-item" href="?menu=product">Product</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex">
          <a class="btn btn-outline-primary" href="index.php" role="button">Login</a>
        </form>
      </div>
    </div>
  </nav>
  <!-- Penutup Navbar -->
<br>
<?php
    switch(@$_GET['menu']){
        case 'user';
        include 'user.php';
        break;
        
        case 'jenis';
        include 'jenis.php';
        break;

        case 'product';
        include 'product.php';
        break;
    }
?>
</div>
<!-- Penutup Container -->
    <!--JS Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <!--Penutup JS Bootstrap-->
    
    <!--DataTables-->
    <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js" ></script>

    <!--DataTables-->
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
    </script>
  </body>
</html>