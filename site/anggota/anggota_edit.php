<?php
if( empty( $_SESSION['id_petugas'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		$id_anggota = $_REQUEST['id_anggota'];
		$nama_anggota = $_REQUEST['nama_anggota'];
		$jk_anggota = $_REQUEST['jk_anggota'];
		$telp_anggota = $_REQUEST['telp_anggota'];
		$alamat_anggota = $_REQUEST['alamat_anggota'];

		$sql = mysqli_query($koneksi, "UPDATE tbl_anggota SET nama_anggota='$nama_anggota', jk_anggota='$jk_anggota', telp_anggota='$telp_anggota', alamat_anggota='$alamat_anggota' WHERE id_anggota='$id_anggota'");

		if($sql == true){
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./admin.php?hlm=anggota">';
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {

		$id_anggota = $_REQUEST['id_anggota'];

		$sql = mysqli_query($koneksi, "SELECT * FROM tbl_anggota WHERE id_anggota='$id_anggota'") or die( mysqli_error($koneksi));
		while($row = mysqli_fetch_array($sql)){

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	
	<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Edit Data Master Anggota Baru</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Beranda</a></li>
              <li class="breadcrumb-item"><a href="./admin.php?hlm=anggota">Anggota</a></li>
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
		<label for="id_anggota" class="col-sm-2 col-form-label">ID Anggota</label>
		<div class="col-sm-4">
			<input type="text" readonly="" class="form-control" id="id_anggota" name="id_anggota" value="<?php echo $row['id_anggota']; ?>" placeholder="Nomor Anggota" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="nama_anggota" class="col-sm-2 col-form-label">Nama Anggota</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama_anggota" name="nama_anggota" value="<?php echo $row['nama_anggota']; ?>" placeholder="Nama Anggota" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="jk_anggota" class="col-sm-2 col-form-label">Jenis Kelamin</label>
		<div class="col-sm-4">
			<select name="jk_anggota" class="form-control" required>
				<option value="<?php echo $row['jk_anggota']; ?>">--- <?php echo $row['jk_anggota']; ?> ---</option>
				<option value="Laki-laki">Laki-laki</option>
				<option value="Perempuan">Perempuan</option>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label for="telp_anggota" class="col-sm-2 col-form-label">Telp</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="telp_anggota" name="telp_anggota" value="<?php echo $row['telp_anggota']; ?>" placeholder="Telp" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="alamat_anggota" class="col-sm-2 col-form-label">Alamat</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="alamat_anggota" name="alamat_anggota" value="<?php echo $row['alamat_anggota']; ?>" placeholder="Alamat" required>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-4">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=anggota" type="submit" class="btn btn-danger">Batal</a>
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
