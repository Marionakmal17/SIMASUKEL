<?php
session_start();
include '../../umum/db.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
$id = $_SESSION['akun']->ID_AKUN;
$akun = mysqli_query($link, "SELECT * FROM AKUN WHERE ID_AKUN = '" . $id . "' ");
$a = mysqli_fetch_object($akun);
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
    <title>Departemen - SI Surat Masuk dan Keluar</title>
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
                <a href="departemen.php" class="active">
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
                <a href="suratKeluar.php">
                    <i class="las la-paper-plane"></i>
                    <h3>Surat Keluar</h3>
                </a>
            </div>
        </aside>

        <main>
            <header>
                <h1>Departemen</h1>
                <div class="user-logo">
                    <ul>
                        <?php if (!empty($a->IMAGE)) { ?>
                            <img src="../../img/profile/<?php echo $a->IMAGE ?>" alt="profile_image" width="80">
                        <?php } else { ?>
                            <img src="../../img/noprofile.jpg" alt="no_profile_image" width="80">
                        <?php } ?>
                        <ul class="dropdown">
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
                <button><a href="tambahDepart.php">Tambah Departemen</a></button>
                <div class="item">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama Departemen</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $departemen = mysqli_query($link, "SELECT * FROM departemen ORDER BY ID_DEPARTEMEN DESC");
                            if (mysqli_num_rows($departemen) > 0) {
                                while ($row = mysqli_fetch_array($departemen)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $no++ ?>
                                        </td>
                                        <td>
                                            <?php echo $row['NAMA_DEPARTEMEN'] ?>
                                        </td>
                                        <td>
                                            <a href="hapus.php?idD=<?php echo $row['ID_DEPARTEMEN'] ?>"
                                                onclick="return confirm('Yakin ingin hapus ?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                            <tr>
                                <td colspan="3">Tidak ada data</td>
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