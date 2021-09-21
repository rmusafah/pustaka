<?php
if( empty( $_SESSION['id_petugas'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

// membaca kode barang terbesar
$hasil = mysqli_query($koneksi, "SELECT max(id_anggota) as maxKode FROM tbl_anggota");
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
$char = "AGT";
$newID = $char . sprintf("%03s", $noUrut);


	if( isset( $_REQUEST['submit'] )){

		$id_anggota = $_REQUEST['id_anggota'];
		$nama_anggota = $_REQUEST['nama_anggota'];
		$jk_anggota = $_REQUEST['jk_anggota'];
		$telp_anggota = $_REQUEST['telp_anggota'];
		$alamat_anggota = $_REQUEST['alamat_anggota'];

		$sql = mysqli_query($koneksi, 
		"INSERT INTO tbl_anggota(id_anggota, nama_anggota, jk_anggota, telp_anggota, alamat_anggota) VALUES('$id_anggota', '$nama_anggota', '$jk_anggota', '$telp_anggota', '$alamat_anggota')") or die( mysqli_error($koneksi) );; 

		if($sql == true){
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./admin.php?hlm=anggota">';
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
            <h1 class="m-0 text-dark"> Tambah Data Master Anggota Baru</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Beranda</a></li>
              <li class="breadcrumb-item"><a href="./admin.php?hlm=anggota">Anggota</a></li>
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
		<label for="id_anggota" class="col-sm-2 col-form-label">ID Anggota</label>
		<div class="col-sm-4">
			<input type="text" readonly="" value="<?php echo $newID; ?>" class="form-control" id="id_anggota" name="id_anggota" placeholder="Nomor Anggota" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="nama_anggota" class="col-sm-2 col-form-label">Nama Anggota</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama_anggota" name="nama_anggota" placeholder="Kategori Anggota" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="jk_anggota" class="col-sm-2 col-form-label">Jenis Kelamin</label>
		<div class="col-sm-4">
			<select name="jk_anggota" class="form-control" required>
				<option value="">--- Pilih Jenis Kelamin ---</option>
				<option value="Laki-laki">Laki-laki</option>
				<option value="Perempuan">Perempuan</option>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label for="telp_anggota" class="col-sm-2 col-form-label">Telp</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="telp_anggota" name="telp_anggota" placeholder="telp_anggota" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="alamat_anggota" class="col-sm-2 col-form-label">Alamat</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="alamat_anggota" name="alamat_anggota" placeholder="Alamat" required>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-4">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=anggota" class="btn btn-danger">Batal</a>
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
