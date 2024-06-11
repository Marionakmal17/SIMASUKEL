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
    <title>Buat Akun - SI Surat Masuk dan Keluar</title>
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
                <a href="buatAkun.php" class="active">
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
                <h1>Buat Akun</h1>
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
                <form action="" class="buat" method="post">
                    <div class="item">
                        <h3>Email</h3>
                        <input type="email" name="email" required>
                    </div>
                    <div class="item">
                        <h3>Program Studi</h3>
                        <div class="item-option">
                            <select name="prodi" required>
                                <option value=""> -- Pilih Prodi -- </option>
                                <?php
                                $prodi = mysqli_query($link, "SELECT * FROM PRODI ORDER BY ID_PRODI ");
                                while ($p = mysqli_fetch_array($prodi)) {
                                    ?>
                                    <option value="<?php echo $p['ID_PRODI'] ?>"> <?php echo $p['NAMA_PRODI'] ?> </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="item">
                        <h3> Departemen</h3>
                        <div class="item-option">
                            <select name="departemen" required>
                                <option value=""> -- Pilih Departemen -- </option>
                                <?php
                                $depart = mysqli_query($link, "SELECT * FROM DEPARTEMEN ORDER BY ID_DEPARTEMEN ");
                                while ($d = mysqli_fetch_array($depart)) {
                                    ?>
                                    <option value="<?php echo $d['ID_DEPARTEMEN'] ?>"> <?php echo $d['NAMA_DEPARTEMEN'] ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="item">
                        <h3>Username</h3>
                        <input type="text" name="user" required>
                    </div>
                    <div class="item">
                        <h3>Password</h3>
                        <input type="password" name="pass" required>
                    </div>
                    <div class="item">
                        <h3>Konfirmasi Password</h3>
                        <input type="password" name="pass-confirm" required>
                    </div>
                    <div class="item">
                        <h3>Foto Profile </h3>
                        <input type="file" name="profile" accept=".jpg , .png">
                    </div>
                    <div class="item">
                        <button type="submit" name="submit">Buat Akun</button>
                    </div>
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $lastIdQuery = mysqli_query($link, "SELECT MAX(ID_AKUN) AS LAST_ID FROM AKUN");
                    $lastIdResult = mysqli_fetch_assoc($lastIdQuery)['LAST_ID'];

                    $idAkun = $lastIdResult + 1;
                    $idAkunFormatted = sprintf('%05d', $idAkun);

                    $email = $_POST['email'];
                    $prodi = $_POST['prodi'];
                    $departemen = $_POST['departemen'];
                    $username = $_POST['user'];
                    $pass = $_POST['pass'];
                    $confirm = $_POST['pass-confirm'];

                    if ($pass === $confirm) {
                        $password = md5($pass);

                        // Proses upload foto profile jika ada
                        $profile = '';
                        if ($_FILES['profile']['name']) {
                            $profile = $_FILES['profile']['name'];
                            $profileTmp = $_FILES['profile']['tmp_name'];
                            $profilePath = '../../img/profile/' . $profile;
                            move_uploaded_file($profileTmp, $profilePath);
                        }

                        // Query untuk menyimpan data ke tabel "akun"
                        $insert = mysqli_query($link, "INSERT INTO AKUN VALUES (
                                '" . $idAkunFormatted . "',
                                '" . $prodi . "',
                                '" . $departemen . "',
                                '" . $username . "',
                                '" . $password . "',
                                '" . $email . "',
                                '" . $profile . "'
                            )");

                        if ($insert) {
                            echo '<script>alert("Buat akun berhasil")</script>';
                            echo '<script>window.location="buatAkun.php"</script>';
                        } else {
                            echo 'Gagal ' . mysqli_error($link);
                        }
                    } else {
                        echo 'Konfirmasi password tidak sesuai.';
                        // Tambahkan tindakan yang sesuai jika konfirmasi password tidak sesuai
                    }
                }
                ?>


            </div>

        </main>
    </div>

</body>

</html>