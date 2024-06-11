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
    <title>Tambah Departemen - SI Surat Masuk dan Keluar</title>
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
                            <img src="../../img/profile/<?php echo $a->IMAGE ?>" alt="profile_image" width="60">
                        <?php } else { ?>
                            <img src="../../img/noprofile.jpg" alt="no_profile_image" width="80">
                        <?php } ?>
                        <div class="dropdown">
                            <a href="profile.php">
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

            <div class="list-item">
                <form action="" method="post">
                    <div class="item">
                        <h3>Nama Departemen</h3>
                        <input type="text" name="nama" required>
                    </div>
                    <div class="item">
                        <button value="submit" name="submit">Tambah</button>
                    </div>
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    // Mendapatkan ID departemen terakhir
                    $lastIdQuery = mysqli_query($link, "SELECT MAX(ID_DEPARTEMEN) AS LAST_ID FROM DEPARTEMEN");
                    $lastIdResult = mysqli_fetch_assoc($lastIdQuery);
                    $lastId = $lastIdResult['LAST_ID'];

                    // Menghasilkan ID departemen berikutnya
                    $nextId = ++$lastId;
                    $nextIdFormatted = 'D' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

                    $nama = $_POST['nama'];

                    $insert = mysqli_query($link, "INSERT INTO DEPARTEMEN VALUES (
                                                    '" . $nextIdFormatted . "',
                                                    '" . $nama . "'
                ) ");
                    if ($insert) {
                        echo '<script>alert("Tambah departemen berhasil")</script>';
                        echo '<script>window.location="departemen.php"</script>';
                    } else {
                        echo 'Gagal ' . mysqli_error($link);
                    }
                }
                ?>
            </div>

        </main>
    </div>

</body>

</html>