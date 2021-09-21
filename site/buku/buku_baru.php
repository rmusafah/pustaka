<?php
if( empty( $_SESSION['id_petugas'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

// membaca kode barang terbesar
$hasil = mysqli_query($koneksi, "SELECT max(id_buku) as maxKode FROM tbl_buku");
$data  = mysqli_fetch_array($hasil);
$kodeID = $data['maxKode'];

// mengambil angka atau bilangan dalam kode buku terbesar,
// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// misal 'BRG001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int) substr($kodeID, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$noUrut++;

// membentuk kode buku baru
// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// misal sprintf("%03s", 12); maka akan dihasilkan '012'
// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
$char = "BK";
$newID = $char . sprintf("%03s", $noUrut);


	if( isset( $_REQUEST['submit'] )){

		$id_buku = $_REQUEST['id_buku'];
		$judul = $_REQUEST['judul'];
		$penulis = $_REQUEST['penulis'];
		$penerbit = $_REQUEST['penerbit'];
		$tahun_terbit = $_REQUEST['tahun_terbit'];

		$sql = mysqli_query($koneksi, 
		"INSERT INTO tbl_buku(id_buku, judul, penulis, penerbit, tahun_terbit) VALUES('$id_buku', '$judul', '$penulis', '$penerbit', '$tahun_terbit')") or die( mysqli_error($koneksi) );; 

		if($sql == true){
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./admin.php?hlm=buku">';
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
            <h1 class="m-0 text-dark"> Tambah Data Master Buku Baru</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Beranda</a></li>
              <li class="breadcrumb-item"><a href="./admin.php?hlm=buku">Buku</a></li>
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
		<label for="id_buku" class="col-sm-2 col-form-label">ID Buku</label>
		<div class="col-sm-4">
			<input type="text" readonly="" value="<?php echo $newID; ?>" class="form-control" id="id_buku" name="id_buku" placeholder="ID Buku" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="judul" class="col-sm-2 col-form-label">Judul</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="penulis" name="penulis" placeholder="Penulis" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Penerbit" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit" placeholder="Tahun" required>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-4">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=buku" class="btn btn-danger">Batal</a>
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
