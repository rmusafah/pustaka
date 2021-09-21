<?php
if( empty( $_SESSION['id_petugas'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

if(isset($_REQUEST['submit'])){

    $id_anggota = $_REQUEST['id_anggota'];

    $sql = mysqli_query($koneksi, "DELETE FROM tbl_anggota WHERE id_anggota='$id_anggota'");
    if($sql == true){
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./admin.php?hlm=anggota">';
        die();
    }
    }
}
?>
