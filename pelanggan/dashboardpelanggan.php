<?php
    session_start();

    // Logout
    if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
        echo "<script>
            var confirmLogout = confirm('Anda yakin untuk logout?');
            if (confirmLogout) {
                // Hapus cookie dengan nama 'login'
                document.cookie = 'login=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                // Redirect ke halaman login atau halaman lain yang sesuai
                alert('Logout Berhasil');
                window.location.href = '../index.php';
            } else {
                // Batal logout
                alert('Logout Dibatalkan');
                window.location.href = 'pemasaran.php';
            }
        </script>";
    exit;
   }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Pemasaran.ico" type="image/x-icon">
    <link rel="stylesheet" href="styledashboard.css">
</head>

<body>
    <div class="top">
        <div class="profile-details">
            <span class="admin_name">Admin</span>
            <i class="bx bx-chevron-down"></i>
            <div class="dropdown">       
                <a href="?logout=true" id="logout">
                    <i class="fas fa-sign-out-alt"></i> Log Out
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <?php
        require_once('../conn.php');

        $username = "";
        $name = "";

        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];

            try {
                // Query ke database untuk mendapatkan nama pelanggan berdasarkan username
                $query = "SELECT nama_pelanggan FROM pelanggan WHERE username = :username";
                $statement = $conn->prepare($query);
                $statement->bindParam(':username', $username);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $name = $result['nama_pelanggan'];
            } catch (PDOException $e) {
                // Tangani kesalahan koneksi database
                echo "Kesalahan: " . $e->getMessage();
            }
        }

        if (!empty($username)) {
            echo "<h2>Hello, $name !</h2>";
        }
        ?>

        <div class="buttons-container">
            <form method="get" action="tagihan.php">
                <button class="tagihan-button" type="submit">Tagihan</button>
            </form>

            <form method="get" action="riwayattransaksi.php">
                <button class="riwayat-button" type="submit">Riwayat</button>
            </form>
        </div>

</body>

</html>
