<?php
require_once('../conn.php');

$errorMessage = '';

function generateRandomPassword() {
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';

    for ($i = 0; $i < $length; $i++) {
        $index = random_int(0, strlen($characters) - 1);
        $password .= $characters[$index];
    }

    return $password;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === '12345') {
        $randomPassword = generateRandomPassword();
        $hashedPassword = password_hash($randomPassword, PASSWORD_DEFAULT);
    
        // Store the hashed password in the database
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $hashedPassword);
        $stmt->execute();
    
        // Set cookie with the username
        setcookie("username", $username, time() + 3600, '/');
    
        // Redirect to the welcome or next page
        echo "
            <script>
                alert('Login Berhasil');
                document.location.href = '../admin/dashboard.php';
            </script> 
        ";
        exit;
    } else {
        // Login gagal
        echo "
            <script>
                alert('Username atau password salah!');
                document.location.href = '../admin/loginadmin.php';
            </script> 
        ";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style_login.css">
    <link rel="icon" href="../Pemasaran.ico" type="image/x-icon">
    <title>Form Login Admin</title>
    <style>
    </style>
</head>

<body>
    <?php if ($errorMessage !== '') : ?>
        <p><?php echo $errorMessage; ?></p>
    <?php endif; ?>

    <form method="POST" action="loginadmin.php">
        <h2>&ensp;&ensp;Login&ensp;&ensp;</h2>
        <input type="text" id="username" name="username" placeholder="Username" required><br><br>
        <input type="password" id="password" name="password" placeholder="Password" required><br><br>
        <input type="submit" name="submit" value=" Log in ">
        <a href="../index2.php" class="btn-back">Kembali</a>
    </form>
</body>

</html>
