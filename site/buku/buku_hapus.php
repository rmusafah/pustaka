<?php
if( empty( $_SESSION['id_petugas'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

if(isset($_REQUEST['submit'])){

    $id_buku = $_REQUEST['id_buku'];

    $sql = mysqli_query($koneksi, "DELETE FROM tbl_buku WHERE id_buku='$id_buku'");
    if($sql == true){
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./admin.php?hlm=buku">';
        die();
    }
    }
}
?>
