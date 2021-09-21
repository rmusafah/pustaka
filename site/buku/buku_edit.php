<?php
if( empty( $_SESSION['id_petugas'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		$id_buku = $_REQUEST['id_buku'];
		$judul = $_REQUEST['judul'];
		$penulis = $_REQUEST['penulis'];
		$penerbit = $_REQUEST['penerbit'];
		$tahun_terbit = $_REQUEST['tahun_terbit'];

		$sql = mysqli_query($koneksi, "UPDATE tbl_buku SET judul='$judul', penulis='$penulis', penerbit='$penerbit', tahun_terbit='$tahun_terbit' WHERE id_buku='$id_buku'");

		if($sql == true){
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./admin.php?hlm=buku">';
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {

		$id_buku = $_REQUEST['id_buku'];

		$sql = mysqli_query($koneksi, "SELECT * FROM tbl_buku WHERE id_buku='$id_buku'") or die( mysqli_error($koneksi));
		while($row = mysqli_fetch_array($sql)){

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	
	<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Edit Data Master buku Baru</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Beranda</a></li>
              <li class="breadcrumb-item"><a href="./admin.php?hlm=buku">buku</a></li>
			  <li class="breadcrumb-item active">Edit Data</li>
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
<div class="card">
<form method="post" action="" class="form-horizontal" role="form">
<div class="card-body">
	<div class="form-group row">
		<label for="id_buku" class="col-sm-2 col-form-label">ID buku</label>
		<div class="col-sm-4">
			<input type="text" readonly="" class="form-control" id="id_buku" name="id_buku" value="<?php echo $row['id_buku']; ?>" placeholder="ID buku" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="judul" class="col-sm-2 col-form-label">Judul</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="judul" name="judul" value="<?php echo $row['judul']; ?>" placeholder="Judul" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="penulis" class="col-sm-2 col-form-label">penulis</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="penulis" name="penulis" value="<?php echo $row['penulis']; ?>" placeholder="penulis" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="penerbit" class="col-sm-2 col-form-label">penerbit</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="penerbit" name="penerbit" value="<?php echo $row['penerbit']; ?>" placeholder="penerbit" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit" value="<?php echo $row['tahun_terbit']; ?>" placeholder="Tahun" required>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-4">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=buku" type="submit" class="btn btn-danger">Batal</a>
		</div>
	</div>
</div>
	<!-- /.card-body -->
</form>
</div>
<!-- /.card -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div>
</div>
<!-- /.content -->

<?php

	}
	}
}
?>
