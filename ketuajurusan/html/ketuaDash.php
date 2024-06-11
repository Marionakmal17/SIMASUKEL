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
    <title>Dashboard - SI Surat Masuk dan Keluar</title>
</head>

<body>

    <div class="container">
        <aside>
            <div class="top">
                <img src="../../img/poliban.jpg" alt="logo_poliban">
            </div>
            <div class="sidebar">
                <a href="ketuaDash.php" class="active">
                    <i class="las la-home"></i>
                    <h3>Dashboard</h3>
                </a>
                <a href="ketuaDeprt.php">
                    <i class="las la-building"></i>
                    <h3>Departemen</h3>
                </a>
                <a href="ketuasuratMasuk.php">
                    <i class="las la-inbox"></i>
                    <h3>Surat Masuk</h3>
                </a>
                <a href="ketuasuratKeluar.php">
                    <i class="las la-paper-plane"></i>
                    <h3>Surat Keluar</h3>
                </a>
            </div>
        </aside>

        <main>
            <header>
                <h1>Dashboard</h1>
                <div class="user-logo">
                    <ul>
                        <?php if (!empty($a->IMAGE)) { ?>
                            <img src="../../img/profile/<?php echo $a->IMAGE ?>" alt="profile_image" width="60">
                        <?php } else { ?>
                            <img src="../../img/noprofile.jpg" alt="no_profile_image" width="80">
                        <?php } ?>
                        <div class="dropdown">
                            <a href="ketuaProfile.php">
                                <i class="las la-user-circle"></i>
                                <h3>Profile</h3>
                            </a>
                            <a href="../../umum/html/keluar.php">
                                <i class="las la-sign-out-alt"></i>
                                <h3>Keluar</h3>
                            </a>
                        </div>
                    </ul>
                </div>
            </header>

            <div class="card">
                <div class="top">
                    <img src="../../img/letter.jpg" alt="Gambar Surat" width="300">
                    <div class="kanan">
                        <h3>Selamat datang</h3>
                        <h1>
                            <?php echo $a->USERNAME ?>
                            </h2>
                            <h3>Di Sitem Informasi surat masuk dan surat keluar</h3>
                    </div>
                </div>
            </div>

            <?php
            $masuk = "SELECT COUNT(*) AS total FROM surat WHERE ID_JENIS = 'J0001' AND PENERIMA = '$username' ";
            $keluar = "SELECT COUNT(*) AS total FROM surat WHERE ID_JENIS = 'J0002' AND PENERIMA = '$username' ";

            // Eksekusi query
            $hasil1 = mysqli_query($link, $masuk);
            $hasil2 = mysqli_query($link, $keluar);

            // Periksa hasil query
            ?>

            <div class="list-grid">
                <div class="insight">
                    <div class="card-content">
                        <div class="card-header">
                            <h3>Surat Masuk</h3>
                            <h2>
                                <?php if ($hasil1) {
                                    $row = mysqli_fetch_assoc($hasil1);
                                    $totalMasuk = $row['total'];
                                    echo $totalMasuk;
                                }
                                ?>
                            </h2>
                        </div>
                        <div class="card-body">
                            <i class="las la-inbox"></i>
                        </div>
                    </div>
                </div>

                <div class="insight">
                    <div class="card-content">
                        <div class="card-header">
                            <h3>Surat Keluar</h3>
                            <h2>
                                <?php if ($hasil2) {
                                    $row = mysqli_fetch_assoc($hasil2);
                                    $totalKeluar = $row['total'];
                                    echo $totalKeluar;
                                }
                                ?>
                            </h2>
                        </div>
                        <div class="card-body">
                            <i class="las la-paper-plane "></i>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

</body>

</html>