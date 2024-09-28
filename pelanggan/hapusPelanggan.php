<?php
include('../conn.php');

if (isset($_POST['deletes'])) {
    $id_pelanggan = $_POST['id_pelanggan'];

    $query1 = "DELETE FROM pelanggan WHERE id_pelanggan IN (SELECT id_pelanggan from pelanggan WHERE id_pelanggan = '$id_pelanggan')";
    $result1 = $conn->query($query1);

    $query2 = "DELETE FROM transaksi WHERE id_pelanggan = '$id_pelanggan'";
    $result2 = $conn->query($query2);


    if ($result1 && $result2) {
        echo "
          <script>
              alert('Data Berhasil Dihapus');
              document.location.href = '../pelanggan/list_pelanggan.php';
          </script> 
      ";
    } else {
        echo "
          <script>
              alert('Data Gagal Dihapus');
              document.location.href = '../pelanggan/list_pelanggan.php';
          </script> 
      ";
    }
}
