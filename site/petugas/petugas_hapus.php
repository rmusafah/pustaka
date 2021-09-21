<?php
if( empty( $_SESSION['id_petugas'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

if(isset($_REQUEST['submit'])){

    $id_petugas = $_REQUEST['id_petugas'];

    if($id_petugas == 1){
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./admin.php?hlm=petugas">';
        die();
    }

    $sql = mysqli_query($koneksi, "DELETE FROM tbl_petugas WHERE id_petugas='$id_petugas'");
    if($sql == true){
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./admin.php?hlm=petugas">';
        die();
    }
    }
}
?>
