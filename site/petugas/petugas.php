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
				include 'petugas_baru.php';
				break;
			case 'edit':
				include 'petugas_edit.php';
				break;
			case 'hapus':
				include 'petugas_hapus.php';
				break;
		}
	} else {

		echo '
		
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	
	<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Data Master Admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Beranda</a></li>
              <li class="breadcrumb-item active">Admin</li>
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
						<a href="./admin.php?hlm=petugas&aksi=baru" type="button" class="btn btn-primary btn-xs"><i class="fas fa-plus nav-icon"></i>Tambah Data</a>
					</div>
				</div>
				
				<div class="card-body">
				<table id="example1" class="table table-bordered table-striped">
				 <thead>
				   <tr class="info">
					 <th width="5%">No</th>
					 <th width="22%">Nama</th>
					 <th width="33%">Telp</th>
					 <th width="20%">Alamat</th>
					 <th width="20%">Tindakan</th>
				   </tr>
				 </thead>
				 <tbody>';

			//skrip untuk menampilkan data dari database
		 	$sql = mysqli_query($koneksi, "SELECT * FROM tbl_petugas");
		 	if(mysqli_num_rows($sql) > 0){
		 		$no = 0;

				 while($row = mysqli_fetch_array($sql)){
	 				$no++;
	 			echo '

				   <tr>
					 <td>'.$no.'</td>
					 <td>'.$row['nama_petugas'].'</td>
					 <td>'.$row['telp_petugas'].'</td>
					 <td>';
					 
					 $string = $row['alamat'];
					 echo nl2br($string);
					 echo'</td>
					 <td>

					<script type="text/javascript" language="JavaScript">
					  	function konfirmasi(){
						  	tanya = confirm("Anda yakin akan menghapus user ini?");
						  	if (tanya == true) return true;
						  	else return false;
						}
					</script>

					 <a href="?hlm=petugas&aksi=edit&id_petugas='.$row['id_petugas'].'" class="btn btn-warning btn-xs"><i class="fas fa-edit nav-icon"></i>Edit</a>
					 <a href="?hlm=petugas&aksi=hapus&submit=yes&id_petugas='.$row['id_petugas'].'" onclick="return konfirmasi()" class="btn btn-danger btn-xs"><i class="fas fa-trash nav-icon"></i>Hapus</a>

					 </td>';
				}
			} else {
				 echo '<td colspan="8"><center><p class="add">Tidak ada data untuk ditampilkan. <u><a href="?hlm=petugas&aksi=baru">Tambah user baru</a></u> </p></center></td></tr>';
			}
			echo '
			 	</tbody>
			</table>
			</div>
            <!-- /.card-body -->
			</div>
			<!-- /.card -->
			</div>
			</div>
			</div>
		</div>
		</div>';
	}
}
?>
