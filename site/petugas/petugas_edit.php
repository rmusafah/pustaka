<?php
if( empty( $_SESSION['id_petugas'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {


	if( isset( $_REQUEST['submit'] )){

        $id_petugas = $_REQUEST['id_petugas'];
		$nama_petugas = $_REQUEST['nama_petugas'];
		$password = $_REQUEST['password'];
		$telp_petugas = $_REQUEST['telp_petugas'];
		$alamat = $_REQUEST['alamat'];

		$sql = mysqli_query($koneksi, "UPDATE tbl_petugas SET nama_petugas='$nama_petugas', password='$password', telp_petugas='$telp_petugas', alamat='$alamat' WHERE id_petugas='$id_petugas'");

		if($sql == true){
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./admin.php?hlm=petugas">';
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {

		$id_petugas = $_REQUEST['id_petugas'];

		$sql = mysqli_query($koneksi, "SELECT * FROM tbl_petugas WHERE id_petugas='$id_petugas'");
		while($row = mysqli_fetch_array($sql)){

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	
	<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Edit Data Master Admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Beranda</a></li>
              <li class="breadcrumb-item"><a href="./admin.php?hlm=petugas">Admin</a></li>
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
<div class="card-body">
<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group row">
		<label for="nama_petugas" class="col-sm-2 col-form-label">Nama</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama_petugas" name="nama_petugas" value="<?php echo $row['nama_petugas']; ?>" placeholder="nama_petugas" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="password" class="col-sm-2 col-form-label">Password</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="password" name="password" value="<?php echo $row['password']; ?>" placeholder="Password" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="telp_petugas" class="col-sm-2 col-form-label">Telp</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="telp_petugas" name="telp_petugas" value="<?php echo $row['telp_petugas']; ?>" placeholder="Nama Admin" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
		<div class="col-sm-4">
			<textarea class="form-control" id="alamat" name="alamat" placeholder="alamat" required><?php echo $row['alamat']; ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=petugas" class="btn btn-danger">Batal</a>
		</div>
	</div>
</form>
</div>
	<!-- /.card-body -->
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
