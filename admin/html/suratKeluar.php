<?php
session_start();
include '../../umum/db.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
$id = $_SESSION['akun']->ID_AKUN;
$akun = mysqli_query($link, "SELECT * FROM AKUN WHERE ID_AKUN = '" . $id . "' ");
$a = mysqli_fetch_object($akun);

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
if (!empty($keyword)) {
    $surat = mysqli_query($link, "SELECT * FROM surat WHERE ID_JENIS = 'J0002' AND (NO_SURAT LIKE '%$keyword%' OR TGL_TERIMA LIKE '%$keyword%' OR PENERIMA LIKE '%$keyword%' OR PERIHAL LIKE '%$keyword%') ORDER BY ID_SURAT DESC");
} else {
    $surat = mysqli_query($link, "SELECT * FROM surat WHERE ID_JENIS = 'J0002' ORDER BY ID_SURAT DESC");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" type="x-icon" href="../../img/poliban.jpg">
    <title>Surat Keluar - SI Surat Masuk dan Keluar</title>
</head>

<body>

    <div class="container">
        <aside>
            <div class="top">
                <img src="../../img/poliban.jpg" alt="logo_poliban">
            </div>
            <div class="sidebar">
                <a href="dashboard.php">
                    <i class="las la-home"></i>
                    <h3>Dashboard</h3>
                </a>
                <a href="departemen.php">
                    <i class="las la-building"></i>
                    <h3>Departemen</h3>
                </a>
                <a href="buatAkun.php" >
                    <i class="las la-user-plus"></i>
                    <h3>buat Akun</h3>
                </a>
                <a href="buatSurat.php">
                    <i class="las la-envelope"></i>
                    <h3>Buat Surat</h3>
                </a>
                <a href="suratMasuk.php">
                    <i class="las la-inbox"></i>
                    <h3>Surat Masuk</h3>
                </a>
                <a href="suratKeluar.php" class="active">
                    <i class="las la-paper-plane"></i>
                    <h3>Surat Keluar</h3>
                </a>
            </div>
        </aside>

        <main>
            <header>
                <h1>Surat Keluar</h1>
                <div class="user-logo">
                    <ul>
                    <?php if (!empty($a->IMAGE)) { ?>
                            <img src="../../img/profile/<?php echo $a->IMAGE ?>" alt="profile_image" width="80">
                        <?php } else { ?>
                            <img src="../../img/noprofile.jpg" alt="no_profile_image" width="80">
                        <?php } ?>                        <ul class="dropdown">
                            <li>
                                <a href="profile.php">
                                    <i class="las la-user-circle"></i>
                                    <h2>Profile</h2>
                                </a>
                            </li>
                            <li>
                                <a href="../../umum/html/keluar.php">
                                    <i class="las la-sign-out-alt"></i>
                                    <h2>Keluar</h2>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </div>
            </header>

            <div class="list-item">
            <form method="GET" action="" class="search-form">
                    <div class="search">
                        <input type="text" name="keyword" placeholder="Cari..." class="search-input">
                        <button type="submit" class="search-button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <div class="item">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>No Surat</td>
                                <td>Tgl Terima</td>
                                <td>Penerima</td>
                                <td>Perihal</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if (mysqli_num_rows($surat) > 0) {
                                while ($row = mysqli_fetch_array($surat)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $no++ ?>
                                        </td>
                                        <td>
                                            <?php echo $row['NO_SURAT'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['TGL_TERIMA'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['PENERIMA'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['PERIHAL'] ?>
                                        </td>
                                        <td>
                                            <a href="editSurat.php?id=<?php echo $row['ID_SURAT'] ?>">Edit</a>
                                            <a href="../../surat/<?php echo $row['FILE']; ?>" download>Unduh</a>
                                            <a href="hapus.php?idSK=<?php echo $row['ID_SURAT'] ?>"
                                                onclick="return confirm('Yakin ingin hapus ?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="6">Tidak ada data</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

</body>

</html>