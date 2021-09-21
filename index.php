<?php

    //memulai session
    session_start();

    //jika ada session, maka akan diarahkan ke halaman dashboard admin
    if(isset($_SESSION['id_petugas'])){

        //mengarahkan ke halaman dashboard admin
        header("Location: ./admin.php");
        die();
    }

    //mengincludekan koneksi database
    include "koneksi.php";

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	
    <!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="aset/plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="aset/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="aset/dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<style type="text/css">
    .bg::before {
            content: '';
            background-image: url('aset/dist/img/background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: scroll;
            position: fixed;
            z-index: -1;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            opacity: 0.7;
            filter:alpha(opacity=10);
    }
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
    <title>Aplikasi Manajemen Perpustakaan</title>
	
  </head>

  <body class="hold-transition login-page bg">

    <div class="login-box">
		<div class="login-logo">
			<h4 class="m-0 text-dark">Aplikasi Manajemen Perpustakaan</h4>
		</div>
		<!-- /.login-logo -->
		
	<?php

    //apabila tombol login di klik akan menjalankan skript dibawah ini
	if( isset( $_REQUEST['login'] ) ){

        //mendeklarasikan data yang akan dimasukkan ke dalam database
		$id_petugas = $_REQUEST['id_petugas'];
		$password = $_REQUEST['password'];

        //skript query ke insert data ke dalam database
		$sql = mysqli_query($koneksi, "SELECT id_petugas, nama_petugas, password, telp_petugas, alamat FROM tbl_petugas WHERE id_petugas='$id_petugas' AND password='$password'");

        //jika skript query benar maka akan membuat session
		if( $sql){
			list($id_petugas, $nama_petugas, $password, $telp_petugas, $alamat) = mysqli_fetch_array($sql);

            //membuat session
            $_SESSION['id_petugas'] = $id_petugas;
			$_SESSION['nama_petugas'] = $nama_petugas;
			$_SESSION['password'] = $password;
			$_SESSION['telp_petugas'] = $telp_petugas;
			$_SESSION['alamat'] = $alamat;

			header("Location: ./admin.php");
			die();
		} else {

			$_SESSION['err'] = '<strong>ERROR!</strong> Username dan Password tidak ditemukan.';
			header('Location: ./');
			die();
		}

	} else {
	?>
	
	<div class="card">
		<div class="card-body login-card-body">
			<p class="login-box-msg">Sign in to start your session</p>
			
      <form method="post" action="">
	  	<?php
		if(isset($_SESSION['err'])){
			$err = $_SESSION['err'];
			echo '<div class="alert alert-warning alert-message">'.$err.'</div>';
            unset($_SESSION['err']);
		}
		?>
	    <div class="input-group mb-3">
          <input type="text" name="id_petugas" class="form-control" placeholder="ID Petugas" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
	  
		</div>
		<!-- /.login-card-body -->
	</div>
	</div>
	<!-- /.login-box -->

<!-- jQuery -->
<script src="aset/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="aset/plugins/bootstrbootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="aset/dist/js/adminlte.min.js"></script>

	<?php
	}
	?>
  </body>
</html>
