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
    <title>Buar Surat - SI Surat Masuk dan Keluar</title>
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
                <a href="buatSurat.php" class="active">
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
                <h1>Buat Surat</h1>
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
                <form action="" class="buat" method="POST" enctype="multipart/form-data">
                    <div class="item">
                        <h3>Jenis Surat</h3>
                        <div class="item-option">
                            <select name="ID_JENIS" required>
                                <option value="" > -- Pilih Jenis Surat -- </option>
                                <?php
                                $jenis = mysqli_query($link, "SELECT * FROM jenis_surat ORDER BY ID_JENIS");
                                while ($j = mysqli_fetch_array($jenis)) {
                                    ?>
                                    <option value="<?php echo $j['ID_JENIS'] ?>"><?php echo $j['NAMA_JENIS'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="item">
                        <h3>Nomor Surat</h3>
                        <input type="text" name="NO_SURAT" required>
                    </div>
                    <div class="item">
                        <h3>Pengirim Surat</h3>
                        <input type="text" name="PENGIRIM" required>
                    </div>
                    <div class="item">
                        <h3>Penerima Surat<p>(Di isi dengan username akun penerima)</p></h3>
                        <input type="text" name="PENERIMA" required>
                    </div>
                    <div class="item">
                        <h3>Tanggal Surat</h3>
                        <input type="date" name="TLG_SURAT" required>
                    </div>
                    <div class="item">
                        <h3>Tanggal Terima</h3>
                        <input type="date" name="TGL_TERIMA" required>
                    </div>
                    <div class="item">
                        <h3>Perihal</h3>
                        <textarea name="PERIHAL" required></textarea>
                    </div>
                    <div class="item">
                        <h3>File</h3>
                        <input type="file" name="surat_file" accept=".pdf" required>
                    </div>
                    <div class="item">
                        <button type="submit" name="submit" class="btn">Buat Surat</button>
                    </div>
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    // Mendapatkan nomor terakhir dari tabel surat
                    $getLastId = mysqli_query($link, "SELECT MAX(ID_SURAT) AS lastId FROM SURAT");
                    $lastId = mysqli_fetch_assoc($getLastId)['lastId'];
                    // Menghasilkan ID Surat baru dengan menambahkan 1 pada nomor terakhir
                    $idSurat = $lastId + 1;
                    $idSuratFormatted = sprintf('%05d', $idSurat);
                    // Mendapatkan id akun yang diloginkan
                    $akun = $_SESSION['akun']->ID_AKUN;
                    $idAkun = $akun;

                    $jenis = $_POST['ID_JENIS'];
                    $noSurat = $_POST['NO_SURAT'];
                    $pengirim = $_POST['PENGIRIM'];
                    $penerima = $_POST['PENERIMA'];
                    $tgl_surat = $_POST['TLG_SURAT'];
                    $tgl_terima = $_POST['TGL_TERIMA'];
                    $perihal = $_POST['PERIHAL'];

                    // Mengelola file yang diunggah
                    $file = $_FILES['surat_file'];

                    // Cek apakah file berhasil diunggah tanpa kesalahan
                    if ($file['error'] === 0) {
                        $file_name = $file['name']; // Nama file asli
                        $file_tmp = $file['tmp_name']; // Lokasi file sementara
                
                        // Tentukan direktori tujuan penyimpanan file
                        $upload_directory = '../../surat/';

                        // Pindahkan file dari lokasi sementara ke direktori tujuan
                        if (move_uploaded_file($file_tmp, $upload_directory . $file_name)) {

                            $insert = mysqli_query($link, "INSERT INTO SURAT VALUES (
                    '" . $idSuratFormatted . "',
                    '" . $idAkun . "',
                    '" . $jenis . "',
                    '" . $noSurat . "',
                    '" . $pengirim . "',
                    '" . $penerima . "',
                    '" . $tgl_surat . "',
                    '" . $tgl_terima . "',
                    '" . $perihal . "',
                    '" . $file_name . "'
                )");
                            if ($insert) {
                                echo '<script>alert("Kirim surat berhasil")</script>';
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
                ?>
            </div>



        </main>
    </div>

</body>

</html>