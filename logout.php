<?php
include('../conn.php');

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
        window.location.href = 'transaksi.php';
    }
</script>";
exit;
?>
