<?php
session_start();
if( empty( $_SESSION['id_petugas'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aplikasi Manajemen Perpustakaan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="aset/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="aset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="aset/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="aset/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	<style type="text/css">
    @media print
    {
    .noprint {display:none;}
    }
	@page{
		margin:0px auto;
	}
	.hide {
		display: none;
	}
	</style>

  </head>

  <body class="hold-transition layout-top-nav">
	
<!-- Site wrapper -->
<div class="wrapper">
<?php include "menu.php"; ?>


	<?php
	if( isset($_REQUEST['hlm'] )){

		$hlm = $_REQUEST['hlm'];

		switch( $hlm ){
			case 'petugas':
				include "site/petugas/petugas.php";
				break;
			case 'anggota':
				include "site/anggota/anggota.php";
				break;
			case 'buku':
				include "site/buku/buku.php";
				break;
			case 'peminjaman':
				include "site/peminjaman/peminjaman.php";
				break;
			case 'pengembalian':
				include "site/pengembalian/pengembalian.php";
				break;
		}
	} else {
	?>
	
	  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Beranda</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Beranda</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	
	
	
	<!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card callout callout-success">
              <div class="card-body">
				<div class="row mb-2">
				<div class="col-sm-2">
				</div>
				<div class="col-sm-6">
					&nbsp;
					<h3>Selamat Datang di Aplikasi Manajemen Perpustakaan</h3>
					&nbsp;
					<p>Halo <strong><?php echo $_SESSION['nama_petugas']; ?></strong>, Anda login sebagai <strong>Admin</strong>
					</p>
				</div>
				</div>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
	<?php
	}
	?>
	
	
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer noprint">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
     <!-- Anything you want -->
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 <a>Aplikasi Manajemen Perpustakaan</a>.</strong>
  </footer>
  
</div> 
<!-- ./wrapper -->


<!-- jQuery -->
<script src="aset/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="aset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="aset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="aset/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="aset/dist/js/demo.js"></script>
<!-- bs-custom-file-input -->
<script src="aset/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- DataTables -->
<script src="aset/plugins/datatables/jquery.dataTables.js"></script>
<script src="aset/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- InputMask -->
<script src="aset/plugins/moment/moment.min.js"></script>
<script src="aset/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
      //Money Euro
    $('[data-mask]').inputmask()
</script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>

  </body>

</html>
<?php
}
?>
