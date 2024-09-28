<?php 
    include('../conn.php');

    if (isset($_POST['deletes'])) {
        $id_transaksi = $_POST['id_transaksi'];
    
        $query1 = "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi'";
        $result1 = $conn->query($query1);    
    
        if ($result1) {
            echo "
              <script>
                  alert('Data Berhasil Dihapus');
                  document.location.href = '../transaksi/transaksi.php';
              </script> 
          ";
        } else {
            echo "
              <script>
                  alert('Data Gagal Dihapus');
                  document.location.href = '../transaksi/transaksi.php';
              </script> 
          ";
        }
    }

?>