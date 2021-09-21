<?php
if( empty( $_SESSION['id_petugas'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		
		$id_pengembalian = $_REQUEST['id_pengembalian'];
		$id_peminjaman = $_REQUEST['id_peminjaman'];
		$tgl_pengembalian = $_REQUEST['tgl_pengembalian'];
		$denda = $_REQUEST['denda'];
		$id_peminjaman = $_REQUEST['id_peminjaman'];
		

		$sql = mysqli_query($koneksi, "UPDATE tbl_pengembalian SET id_peminjaman='$id_peminjaman', tgl_pengembalian='$tgl_pengembalian', denda='$denda', id_peminjaman='$id_peminjaman' WHERE id_pengembalian='$id_pengembalian'");

		if($sql == true){
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./admin.php?hlm=pengembalian">';
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {

		$id_pengembalian = $_REQUEST['id_pengembalian'];

		$sql = mysqli_query($koneksi, "SELECT * FROM tbl_pengembalian WHERE id_pengembalian='$id_pengembalian'") or die( mysqli_error($koneksi));
		while($row = mysqli_fetch_array($sql)){

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	
	<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Edit Data Master pengembalian Baru</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Beranda</a></li>
              <li class="breadcrumb-item"><a href="./admin.php?hlm=pengembalian">pengembalian</a></li>
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
<!-- atribut enctype berfungsi untuk memberikan intruksi pada php form ini untuk mengupload file -->
<form method="post" action="" class="form-horizontal" role="form" enctype="multipart/form-data">
<div class="card-body">	
	
	<div class="form-group row">
		<label for="id_pengembalian" class="col-sm-2 col-form-label">ID pengembalian</label>
		<div class="col-sm-4">
			<input type="text" readonly="" value="<?php echo $row['id_pengembalian']; ?>" class="form-control" id="id_pengembalian" name="id_pengembalian" placeholder="ID pengembalian" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="tgl_pengembalian" class="col-sm-2 col-form-label">Tanggal pengembalian</label>
		<div class="col-sm-4">
			<input type="date" value="<?php echo $row['tgl_pengembalian']; ?>" class="form-control" id="tgl_pengembalian" name="tgl_pengembalian" placeholder="Tanggal Pinjam" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="denda" class="col-sm-2 col-form-label">Denda</label>
		<div class="col-sm-4">
			<input type="text" value="<?php echo $row['denda']; ?>" class="form-control" id="denda" name="denda" placeholder="Denda" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="id_peminjaman" class="col-sm-2 col-form-label">ID Peminjaman</label>
		<div class="col-sm-4">
			<input type="text" readonly="" value="<?php echo $row['id_peminjaman']; ?>" class="form-control" id="id_peminjaman" name="id_peminjaman" placeholder="id_peminjaman" required>
		</div>
	</div>
	
	
	
	<div class="form-group row">
		<div class="col-sm-4">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=pengembalian" type="submit" class="btn btn-danger">Batal</a>
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
