<?php
    if( !empty( $_SESSION['id_petugas'] ) ){
    include "koneksi.php";
?>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-primary navbar-dark">
    <div class="container">


      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="admin.php" class="nav-link">Beranda</a>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Data Master</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">

              <li><a href="./admin.php?hlm=petugas" class="dropdown-item">Data Petugas</a></li>
			  <li><a href="./admin.php?hlm=anggota" class="dropdown-item">Data Anggota</a></li>
			  <li><a href="./admin.php?hlm=buku" class="dropdown-item">Data Buku</a></li>
			  <li><a href="./admin.php?hlm=peminjaman" class="dropdown-item">Data Peminjaman</a></li>
			  <li><a href="./admin.php?hlm=pengembalian" class="dropdown-item">Data Pengembalian</a></li>
			  
            </ul>
          </li>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
	  <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="aset/dist/img/images.jpg" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline"><?php echo $_SESSION['nama_petugas']; ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-info">
            <img src="aset/dist/img/images.jpg" class="img-circle elevation-2" alt="User Image">

            <p>
              <?php echo $_SESSION['nama_petugas']; ?> - Admin
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="?hlm=petugas&aksi=edit&id_petugas=<?php echo $_SESSION['id_petugas']; ?>" class="btn btn-default btn-flat">Edit User</a>
            <a href="logout.php" class="btn btn-default btn-flat float-right">Sign out</a>
          </li>
        </ul>
      </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->
  

<?php
} else {
	header("Location: ./");
	die();
}
?>
