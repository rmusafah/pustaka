<?php 
require_once'koneksi.php';
?>
<?php

if( empty( $_SESSION['id_petugas'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	
	if( isset( $_REQUEST['aksi'] )){
		$aksi = $_REQUEST['aksi'];
		switch($aksi){
			case 'baru':
				include 'peminjaman_baru.php';
				break;
			case 'edit':
				include 'peminjaman_edit.php';
				break;
			case 'hapus':
				include 'peminjaman_hapus.php';
				break;
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
            <h1 class="m-0 text-dark"> Data Master Peminjaman</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Beranda</a></li>
              <li class="breadcrumb-item active">Peminjaman</li>
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
	<div class="card-header">
		<div class="box pull-right">
			<a href="./admin.php?hlm=peminjaman&aksi=baru" type="button" class="btn btn-primary btn-xs"><i class="fas fa-plus nav-icon"></i>Tambah Data</a>
		</div>
	</div>
<!-- /.card-header -->
<div class="card-body">
<table id="example1" class="table table-bordered table-striped">
				 <thead>
				   <tr class="info">
					 <th width="5%">No</th>
					 <th width="10%">ID Peminjaman</th>
					 <th width="10%">Tanggal Pinjam</th>
					 <th width="10%">Tanggal Kembali</th>
					 <th width="10%">Judul</th>
					 <th width="10%">Nama Anggota</th>
					 <th width="10%">Nama Petugas</th>
					 <th width="20%">Tindakan</th>
				   </tr>
				 </thead>
<tbody>
<?php
if(!ISSET($_POST['submit'])){

$sql = "SELECT * FROM tbl_peminjaman, tbl_buku, tbl_anggota, tbl_petugas WHERE tbl_peminjaman.id_buku=tbl_buku.id_buku AND tbl_peminjaman.id_anggota=tbl_anggota.id_anggota AND tbl_peminjaman.id_petugas=tbl_petugas.id_petugas";
$no = 0;
$query = mysqli_query($koneksi, $sql);
while ($row = mysqli_fetch_array($query)){
$no++;

?>
<tr>
 <td><?php echo $no; ?></td>
 <td><?php echo $row['id_peminjaman']; ?></td>
 <td><?php echo $row['tgl_pinjam']; ?></td>	 
 <td><?php echo $row['tgl_kembali']; ?></td> 
 <td><?php echo $row['judul']; ?></td> 
 <td><?php echo $row['nama_anggota']; ?></td> 
 <td><?php echo $row['nama_petugas']; ?></td> 
 <td>
 		<script type="text/javascript" language="JavaScript">
			function konfirmasi(){
			tanya = confirm("Anda yakin akan menghapus user ini?");
			if (tanya == true) return true;
			else return false;
			}
		</script>

		<a href="?hlm=peminjaman&aksi=edit&id_peminjaman=<?php echo $row['id_peminjaman']; ?>" class="btn btn-warning btn-xs"><i class="fas fa-edit nav-icon"></i>Edit</a>
		<a href="?hlm=peminjaman&aksi=hapus&submit=yes&id_peminjaman=<?php echo $row['id_peminjaman']; ?>" onclick="return konfirmasi()" class="btn btn-danger btn-xs"><i class="fas fa-trash nav-icon"></i>Hapus</a>

 </td>
</tr>

<?php } } ?>

<?php  
$sql = mysqli_query($koneksi, "SELECT * FROM tbl_peminjaman");
if(mysqli_num_rows($sql) < 1){
 echo '<td colspan="8"><center><p class="add">Tidak ada data untuk ditampilkan. <u><a href="?hlm=peminjaman&aksi=baru">Tambah data baru</a></u> </p></center></td></tr>';}
?>
<?php }} ?>
	</tbody>
</table>

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
	</div>
	<!-- /.content-wrapper -->


