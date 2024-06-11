<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../css/login.css">
    <link rel="shortcut icon" type="x-icon" href="../../img/poliban.jpg">
    <title>Login - SI Surat Masuk dan Keluar</title>
</head>

<body>

    <div class="container">
        <form action="" class="login" method="post">
            <div class="login-form">
                <img src="../../img/poliban.jpg" alt="logo_poliban">
                <div class="form-item">
                    <h5>Sistem Informasi Surat Masuk & Surat Keluar</h5>
                </div>
                <div class="form-item">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                </div>
                <div class="form-item">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="form-item">
                    <button type="submit" name="submit" class="btn">Login</button>
                </div>
                <div class="form-item">
                    <h5>Lupa password?? Silakan hubungi admin</h5>
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            session_start();
            include '../db.php';
            $email = mysqli_real_escape_string($link, $_POST['email']);
            $pass = mysqli_real_escape_string($link, $_POST['password']);

            $result = mysqli_query($link, "SELECT * FROM akun WHERE email = '" . $email . "' AND password = '" . md5($pass) . "' ");

            if (mysqli_num_rows($result) > 0) {
                $d = mysqli_fetch_object($result);
                $_SESSION['status_login'] = true;
                $_SESSION['akun'] = $d;
                $_SESSION['id'] = $d->ID_DEPARTEMEN;

                // Pengecekan peran pengguna dan pemilihan halaman utama yang sesuai
                if ($d->ID_DEPARTEMEN == 'D0001') {
                    echo '<script>window.location="../../admin/html/dashboard.php"</script>';
                } elseif ($d->ID_DEPARTEMEN == 'D0002') {
                    echo '<script>window.location="../../ketuajurusan/html/ketuaDash.php"</script>';
                } elseif ($d->ID_DEPARTEMEN == 'D0003') {
                    echo '<script>window.location="../../ketuaprodi/html/ketuapDash.php"</script>';
                } elseif ($d->ID_DEPARTEMEN == 'D0004') {
                    echo '<script>window.location="../../dosen/html/dosenDash.php"</script>';
                } else {
                    echo '<script>alert("Peran pengguna tidak valid")</script>';
                }
            } else {
                echo '<script>alert("Username atau Password Anda salah")</script>';
            }
        }

        ?>


    </div>

</body>

</html>