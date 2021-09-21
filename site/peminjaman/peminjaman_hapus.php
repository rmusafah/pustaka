<?php
if( empty( $_SESSION['id_petugas'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

if(isset($_REQUEST['submit'])){

    $id_peminjaman = $_REQUEST['id_peminjaman'];

    $sql = mysqli_query($koneksi, "DELETE FROM tbl_peminjaman WHERE id_peminjaman='$id_peminjaman'");
    if($sql == true){
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./admin.php?hlm=peminjaman">';
        die();
    }
    }
}
?>
