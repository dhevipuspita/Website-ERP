<?php
session_start();
require_once('../conn.php');

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $query = "SELECT * FROM pelanggan WHERE username = :username";
        
        $statement = $conn->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $storedPassword = $row['password'];

            if (password_verify($password, $storedPassword)) {
                $_SESSION['username'] = $username;
                header("Location: dashboardpelanggan.php");
                exit;
            } else {
                $errorMessage = 'Username atau password salah!';
            }
        } else {
            $errorMessage = 'Username atau password salah!';
        }
    } catch (PDOException $e) {
        $errorMessage = 'Kesalahan: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Pemasaran.ico" type="image/x-icon">
    <title>Form Login Pelanggan</title>
    <link rel="stylesheet" href="../style_login.css">
</head>

<body>
    <?php if ($errorMessage !== '') : ?>
        <p><?php echo $errorMessage; ?></p>
    <?php endif; ?>

    <form method="POST" action="loginpelanggan.php">
        <h2>Login</h2>
        <input type="text" id="username" name="username" placeholder="Username" required><br><br>
        <input type="password" id="password" name="password" placeholder="Password" required><br><br>
        <input type="submit" name="submit" value="Login">
        <a href="../index2.php" class="btn-back">Kembali</a>
    </form>
</body>

</html>
