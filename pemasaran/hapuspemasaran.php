<?php 
    include('../conn.php');

    if (isset($_POST['deletes'])) {
        $id_pemasaran = $_POST['id_pemasaran'];
    
        $query1 = "DELETE FROM pemasaran WHERE id_pemasaran = '$id_pemasaran'";
        $result1 = $conn->query($query1);    
    
        if ($result1) {
            echo "
              <script>
                  alert('Data Berhasil Dihapus');
                  document.location.href = '../pemasaran/pemasaran.php';
              </script> 
          ";
        } else {
            echo "
              <script>
                  alert('Data Gagal Dihapus');
                  document.location.href = '../pemasaran/pemasaran.php';
              </script> 
          ";
        }
    }