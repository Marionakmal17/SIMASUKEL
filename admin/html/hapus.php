<?php
include '../../umum/db.php';

if (isset($_GET['idD'])) {
    $delete = mysqli_query($link, "DELETE FROM departemen WHERE ID_DEPARTEMEN = '".$_GET['idD']."' ");
    echo'<script>window.location="departemen.php"</script>';
}

if(isset($_GET['idSM'])){
    $suratMasuk = mysqli_query($link, "SELECT FILE FROM SURAT WHERE ID_SURAT = '".$_GET['idSM']."'");
    $sm = mysqli_fetch_object($suratMasuk);

    unlink('../../surat/'.$sm->FILE);

    $delete = mysqli_query($link, "DELETE FROM surat WHERE ID_SURAT = '".$_GET['idSM']."' ");
    echo'<script>window.location="suratMasuk.php"</script>';
}

if(isset($_GET['idSK'])){
    $suratKeluar = mysqli_query($link, "SELECT FILE FROM SURAT WHERE ID_SURAT = '".$_GET['idSK']."'");
    $sk = mysqli_fetch_object($suratKeluar);

    unlink('../../surat/'.$sk->FILE);

    $delete = mysqli_query($link, "DELETE FROM surat WHERE ID_SURAT = '".$_GET['idSK']."' ");
    echo'<script>window.location="suratKeluar.php"</script>';
}
?>