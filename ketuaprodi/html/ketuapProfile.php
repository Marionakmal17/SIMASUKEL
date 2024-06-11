<?php
session_start();
include '../../umum/db.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="../../umum/html/login.php"</script>';
}
$id = $_SESSION['akun']->ID_AKUN;
$akun = mysqli_query($link, "SELECT * FROM AKUN WHERE ID_AKUN = '" . $id . "' ");
$a = mysqli_fetch_object($akun);
$idP = $_SESSION['akun']->ID_PRODI;
$prodi = mysqli_query($link, "SELECT * FROM PRODI WHERE ID_PRODI = '" . $idP . "' ");
$p = mysqli_fetch_object($prodi);
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" type="x-icon" href="../../img/poliban.jpg">
    <title>Profile - SI Surat Masuk dan Keluar</title>
</head>
<body>
    <div class="container">
        <aside>
            <div class="top">
                <img src="../../img/poliban.jpg" alt="logo_poliban">
            </div>
            <div class="sidebar">
                <a href="ketuapDash.php">
                    <i class="las la-home"></i>
                    <h3>Dashboard</h3>
                </a>
                <a href="ketuapDeprt.php">
                    <i class="las la-building"></i>
                    <h3>Departemen</h3>
                </a>
                <a href="ketuapsuratMasuk.php">
                    <i class="las la-inbox"></i>
                    <h3>Surat Masuk</h3>
                </a>
                <a href="ketuapsuratKeluar.php">
                    <i class="las la-paper-plane"></i>
                    <h3>Surat Keluar</h3>
                </a>
            </div>
        </aside>
        <main>
            <header>
                <h1>Profile</h1>
                <div class="user-logo">
                    <ul>
                        <?php if (!empty($a->IMAGE)) { ?>
                            <img src="../../img/profile/<?php echo $a->IMAGE ?>" alt="profile_image" width="80">
                        <?php } else { ?>
                            <img src="../../img/noprofile.jpg" alt="no_profile_image" width="80">
                        <?php } ?>
                        <div class="dropdown">
                            <a href="ketuapProfile.php">
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
            <div class="list-profile">
                <form class="profile" action="" method="POST" enctype="multipart/form-data">
                    <div class="item-img">
                        <?php if (!empty($a->IMAGE)) { ?>
                            <img src="../../img/profile/<?php echo $a->IMAGE ?>"  width="120" >
                        <?php } else { ?>
                            <img src="../../img/noprofile.jpg" width="120">
                        <?php } ?>
                        <div class="upload">
                            <input type="file" name="profile" accept=".jpg" readonly>
                        </div>
                    </div>
                    <div class="item">
                        <input type="text" name="username" value="<?php echo $a->USERNAME ?>" readonly>
                    </div>
                    <div class="item">
                        <input type="text" name="prodi" value="<?php echo $p->NAMA_PRODI ?>" readonly>
                    </div>
                    <div class="item">
                        <input type="email" name="email" value="<?php echo $a->EMAIL ?>" readonly>
                    </div>
                </form>
                <!-- <?php
                if (isset($_POST['submit'])) {
                    $username = $_POST['USERNAME'];
                    $prodi = $_POST['PRODI'];
                    $email = $_POST['EMAIL'];

                    // Mengelola file yang diunggah
                    $file = $_FILES['profile'];

                    // Cek apakah file berhasil diunggah tanpa kesalahan
                    if ($file['error'] === 0) {
                        $file_name = $file['name']; // Nama file asli
                        $file_tmp = $file['tmp_name']; // Lokasi file sementara

                        // Tentukan direktori tujuan penyimpanan file
                        $upload_directory = '../../img/profile/';

                        // Pindahkan file dari lokasi sementara ke direktori tujuan
                        if (move_uploaded_file($file_tmp, $upload_directory . $file_name)) {
                            $update = mysqli_query($link, "UPDATE AKUN SET
                            FOTO_PROFILE = '" . $file_name . "',
                            USERNAME = '" . $username . "',
                            PRODI = '" . $prodi . "',
                            EMAIL = '" . $email . "'
                            WHERE ID_AKUN = '".$_GET['id']."' ");
                            if ($update) {
                                echo '<script>alert("Ubah profil berhasil")</script>';
                            } else {
                                echo 'Gagal ' . mysqli_error($link);
                            }
                        } else {
                            // Gagal mengunggah file
                            echo 'Gagal mengunggah file.';
                        }
                    } else {
                        // Terjadi kesalahan saat mengunggah file
                        echo 'Terjadi kesalahan saat mengunggah file: ' . $file['error'];
                    }
                }
                ?> -->
            </div>
        </main>
    </div>
</body>
</html>
