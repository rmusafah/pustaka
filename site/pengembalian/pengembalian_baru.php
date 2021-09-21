<?php
if( empty( $_SESSION['id_petugas'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	
// membaca kode barang terbesar
$hasil = mysqli_query($koneksi, "SELECT max(id_pengembalian) as maxKode FROM tbl_pengembalian");
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
$char = "KMB";
$newID = $char . sprintf("%03s", $noUrut);

	if( isset( $_REQUEST['submit'] )){

		$id_pengembalian = $_REQUEST['id_pengembalian'];
		$id_peminjaman = $_REQUEST['id_peminjaman'];
		$tgl_pengembalian = $_REQUEST['tgl_pengembalian'];
		$denda = $_REQUEST['denda'];
		

		$sql = mysqli_query($koneksi, 
		"INSERT INTO tbl_pengembalian(id_pengembalian, id_peminjaman, tgl_pengembalian, denda) VALUES('$id_pengembalian','$id_peminjaman', '$tgl_pengembalian', '$denda')") or die( mysqli_error($koneksi) );; 

		if($sql == true){
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./admin.php?hlm=pengembalian">';
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
            <h1 class="m-0 text-dark"> Tambah Data Master pengembalian Baru</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Beranda</a></li>
              <li class="breadcrumb-item"><a href="./admin.php?hlm=pengembalian">pengembalian</a></li>
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
		<label for="id_pengembalian" class="col-sm-2 col-form-label">ID pengembalian</label>
		<div class="col-sm-4">
			<input type="text" readonly="" value="<?php echo $newID; ?>" class="form-control" id="id_pengembalian" name="id_pengembalian" placeholder="ID pengembalian" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="tgl_pengembalian" class="col-sm-2 col-form-label">Tanggal pengembalian</label>
		<div class="col-sm-4">
			<input type="date" class="form-control" id="tgl_pengembalian" name="tgl_pengembalian" placeholder="Tanggal pengembalian" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="denda" class="col-sm-2 col-form-label">Denda</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="denda" name="denda" placeholder="Denda" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="id_peminjaman" class="col-sm-2 col-form-label">ID Peminjaman</label>
		<div class="col-sm-4">
			<select class="form-control" name="id_peminjaman" required>
			<?php
			//Perintah sql untuk menampilkan semua data pada tabel jurusan
				$sql=mysqli_query($koneksi, "SELECT * FROM tbl_peminjaman");
				$no=0;
				while ($data = mysqli_fetch_array($sql)) {
				$no++;
			?>
				<option value="<?php echo $data['id_peminjaman'];?>"><?php echo $data['id_peminjaman'];?></option>
			<?php 
				}
			?>
			</select>
		</div>
	</div>

	<div class="form-group row">
		<div class="col-sm-4">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=pengembalian" class="btn btn-danger">Batal</a>
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
