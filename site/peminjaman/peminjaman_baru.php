<?php
if( empty( $_SESSION['id_petugas'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	
// membaca kode barang terbesar
$hasil = mysqli_query($koneksi, "SELECT max(id_peminjaman) as maxKode FROM tbl_peminjaman");
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
$char = "PJM";
$newID = $char . sprintf("%03s", $noUrut);

	if( isset( $_REQUEST['submit'] )){

		$id_peminjaman = $_REQUEST['id_peminjaman'];
		$tgl_pinjam = $_REQUEST['tgl_pinjam'];
		$tgl_kembali = $_REQUEST['tgl_kembali'];
		$id_buku = $_REQUEST['id_buku'];
		$id_anggota = $_REQUEST['id_anggota'];
		$id_petugas = $_REQUEST['id_petugas'];
		

		$sql = mysqli_query($koneksi, 
		"INSERT INTO tbl_peminjaman(id_peminjaman, tgl_pinjam, tgl_kembali, id_buku, id_anggota, id_petugas) VALUES('$id_peminjaman', '$tgl_pinjam', '$tgl_kembali', '$id_buku', '$id_anggota', '$id_petugas')") or die( mysqli_error($koneksi) );; 

		if($sql == true){
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./admin.php?hlm=peminjaman">';
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
            <h1 class="m-0 text-dark"> Tambah Data Master Peminjaman Baru</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Beranda</a></li>
              <li class="breadcrumb-item"><a href="./admin.php?hlm=peminjaman">Peminjaman</a></li>
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
		<label for="id_peminjaman" class="col-sm-2 col-form-label">ID Peminjaman</label>
		<div class="col-sm-4">
			<input type="text" readonly="" value="<?php echo $newID; ?>" class="form-control" id="id_peminjaman" name="id_peminjaman" placeholder="ID Peminjaman" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="tgl_pinjam" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
		<div class="col-sm-4">
			<input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" placeholder="Tanggal Pinjam" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="tgl_kembali" class="col-sm-2 col-form-label">Tanggal Kembali</label>
		<div class="col-sm-4">
			<input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" placeholder="Tanggal Kembali" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="id_buku" class="col-sm-2 col-form-label">Buku</label>
		<div class="col-sm-4">
			<select class="form-control" name="id_buku" required>
			<?php
			//Perintah sql untuk menampilkan semua data pada tabel jurusan
				$sql=mysqli_query($koneksi, "SELECT * FROM tbl_buku");
				$no=0;
				while ($data = mysqli_fetch_array($sql)) {
				$no++;
			?>
				<option value="<?php echo $data['id_buku'];?>"><?php echo $data['id_buku'];?> - <?php echo $data['judul'];?></option>
			<?php 
				}
			?>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label for="id_anggota" class="col-sm-2 col-form-label">Anggota</label>
		<div class="col-sm-4">
			<select class="form-control" name="id_anggota" required>
			<?php
			//Perintah sql untuk menampilkan semua data pada tabel jurusan
				$sql=mysqli_query($koneksi, "SELECT * FROM tbl_anggota");
				$no=0;
				while ($data = mysqli_fetch_array($sql)) {
				$no++;
			?>
				<option value="<?php echo $data['id_anggota'];?>"><?php echo $data['id_anggota'];?> - <?php echo $data['nama_anggota'];?></option>
			<?php 
				}
			?>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label for="id_petugas" class="col-sm-2 col-form-label">Petugas</label>
		<div class="col-sm-4">
			<input type="text" readonly="" value="<?php echo $_SESSION['id_petugas'] ?>" class="form-control" id="id_petugas" name="id_petugas" placeholder="ID Petugas" required>
		</div>
	</div>

	<div class="form-group row">
		<div class="col-sm-4">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=peminjaman" class="btn btn-danger">Batal</a>
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
