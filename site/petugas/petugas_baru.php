<?php
if( empty( $_SESSION['id_petugas'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	
// membaca kode barang terbesar
$hasil = mysqli_query($koneksi, "SELECT max(id_petugas) as maxKode FROM tbl_petugas");
$data  = mysqli_fetch_array($hasil);
$kodeID = $data['maxKode'];

// mengambil angka atau bilangan dalam kode anggota terbesar,
// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// misal 'BRG001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int) substr($kodeID, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$noUrut++;

// membentuk kode anggota baru
// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// misal sprintf("%03s", 12); maka akan dihasilkan '012'
// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
$char = "PTG";
$newID = $char . sprintf("%03s", $noUrut);
	
	if( isset( $_REQUEST['submit'] )){

		$id_petugas = $_REQUEST['id_petugas'];
		$nama_petugas = $_REQUEST['nama_petugas'];
		$password = $_REQUEST['password'];
		$telp_petugas = $_REQUEST['telp_petugas'];
		$alamat = $_REQUEST['alamat'];

		$sql = mysqli_query($koneksi, "INSERT INTO tbl_petugas(id_petugas, nama_petugas, password, telp_petugas, alamat) VALUES('$id_petugas', '$nama_petugas', '$password', '$telp_petugas', '$alamat')");

		if($sql == true){
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./admin.php?hlm=petugas">';
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
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
            <h1 class="m-0 text-dark"> Tambah Data Master Admin Baru</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Beranda</a></li>
              <li class="breadcrumb-item"><a href="./admin.php?hlm=petugas">Admin</a></li>
			  <li class="breadcrumb-item active">Tambah Data</li>
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
		<label for="id_petugas" class="col-sm-2 col-form-label">ID Petugas</label>
		<div class="col-sm-4">
			<input type="text" readonly="" value="<?php echo $newID; ?>" class="form-control" id="id_petugas" name="id_petugas" placeholder="ID" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="nama_petugas" class="col-sm-2 col-form-label">Nama</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama_petugas" name="nama_petugas" placeholder="Nama" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="password" class="col-sm-2 col-form-label">Password</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="password" name="password" placeholder="Password" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="telp_petugas" class="col-sm-2 col-form-label">Telp</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="telp_petugas" name="telp_petugas" placeholder="Telp" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
		<div class="col-sm-4">
			<textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" required></textarea>
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
?>
