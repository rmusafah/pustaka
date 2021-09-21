<?php
if( empty( $_SESSION['id_petugas'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		$id_peminjaman = $_REQUEST['id_peminjaman'];
		$tgl_pinjam = $_REQUEST['tgl_pinjam'];
		$tgl_kembali = $_REQUEST['tgl_kembali'];
		$id_buku = $_REQUEST['id_buku'];
		$id_anggota = $_REQUEST['id_anggota'];
		$id_petugas = $_REQUEST['id_petugas'];
		

		$sql = mysqli_query($koneksi, "UPDATE tbl_peminjaman SET tgl_pinjam='$tgl_pinjam', tgl_kembali='$tgl_kembali', id_buku='$id_buku', id_anggota='$id_anggota', id_petugas='$id_petugas' WHERE id_peminjaman='$id_peminjaman'");

		if($sql == true){
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./admin.php?hlm=peminjaman">';
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {

		$id_peminjaman = $_REQUEST['id_peminjaman'];

		$sql = mysqli_query($koneksi, "SELECT * FROM tbl_peminjaman WHERE id_peminjaman='$id_peminjaman'") or die( mysqli_error($koneksi));
		while($row = mysqli_fetch_array($sql)){

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	
	<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Edit Data Master Peminjaman Baru</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Beranda</a></li>
              <li class="breadcrumb-item"><a href="./admin.php?hlm=peminjaman">Peminjaman</a></li>
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
		<label for="id_peminjaman" class="col-sm-2 col-form-label">ID Peminjaman</label>
		<div class="col-sm-4">
			<input type="text" readonly="" value="<?php echo $row['id_peminjaman']; ?>" class="form-control" id="id_peminjaman" name="id_peminjaman" placeholder="ID Peminjaman" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="tgl_pinjam" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
		<div class="col-sm-4">
			<input type="date" value="<?php echo $row['tgl_pinjam']; ?>" class="form-control" id="tgl_pinjam" name="tgl_pinjam" placeholder="Tanggal Pinjam" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="tgl_kembali" class="col-sm-2 col-form-label">Tanggal Kembali</label>
		<div class="col-sm-4">
			<input type="date" value="<?php echo $row['tgl_kembali']; ?>" class="form-control" id="tgl_kembali" name="tgl_kembali" placeholder="Tanggal Kembali" required>
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
			<input type="text" readonly="" value="<?php echo $row['id_anggota'] ?>" class="form-control" id="id_anggota" name="id_anggota" placeholder="ID Anggota" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="id_petugas" class="col-sm-2 col-form-label">Petugas</label>
		<div class="col-sm-4">
			<input type="text" readonly="" value="<?php echo $row['id_petugas'] ?>" class="form-control" id="id_petugas" name="id_petugas" placeholder="ID Petugas" required>
		</div>
	</div>
	
	
	
	<div class="form-group row">
		<div class="col-sm-4">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=peminjaman" type="submit" class="btn btn-danger">Batal</a>
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
