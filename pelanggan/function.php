<?php

//Koneksi Ke Database
require '../conn.php';

function addPelanggan($data)
{
    global $conn;

    $nama_pelanggan =  htmlspecialchars($data["nama_pelanggan"]);
    $username =  htmlspecialchars($data["username"]);
    $password =  htmlspecialchars($data["password"]);
    $alamat_pelanggan =  htmlspecialchars($data["alamat_pelanggan"]);
    $no_hp_pelanggan =  htmlspecialchars($data["no_hp_pelanggan"]);

    // Mendapatkan ID terakhir yang disisipkan
    $lastIdQuery = "SELECT MAX(SUBSTRING(id_pelanggan, 4)) AS max_id FROM pelanggan";
    $stmt = $conn->prepare($lastIdQuery);
    $stmt->execute();
    $lastIdRow = $stmt->fetch(PDO::FETCH_ASSOC);
    $lastId = $lastIdRow['max_id'];
    $newIdNumber = ($lastId !== null) ? intval($lastId) + 1 : 1;

    // Menghasilkan ID baru dengan gabungan karakter dan angka
    $newId = 'PLG' . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT);

    // Mengacak dan meng-hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO pelanggan (id_pelanggan, nama_pelanggan, username, password, alamat_pelanggan, no_hp_pelanggan)
            VALUES (:id_pelanggan, :nama_pelanggan, :username, :password, :alamat_pelanggan, :no_hp_pelanggan)";
    $statement = $conn->prepare($query);
    $statement->bindParam(':id_pelanggan', $newId);
    $statement->bindParam(':nama_pelanggan', $nama_pelanggan);
    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $hashedPassword);
    $statement->bindParam(':alamat_pelanggan', $alamat_pelanggan);
    $statement->bindParam(':no_hp_pelanggan', $no_hp_pelanggan);
    $statement->execute();

}


// function.php

function updatePelanggan($data)
{
    global $conn;

    $id_pelanggan = htmlspecialchars($data["id_pelanggan"]);
    $nama_pelanggan = htmlspecialchars($data["nama_pelanggan"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]); // Simpan password yang dikirimkan dalam variabel

    // Jika password tidak diubah (kosong), ambil password dari database sebagai nilai default
    if (empty($password)) {
        $query = "SELECT password FROM pelanggan WHERE id_pelanggan = :id_pelanggan";
        $statement = $conn->prepare($query);
        $statement->bindParam(':id_pelanggan', $id_pelanggan);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $password = $row['password'];
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
    }

    $alamat_pelanggan = htmlspecialchars($data["alamat_pelanggan"]);
    $no_hp_pelanggan = htmlspecialchars($data["no_hp_pelanggan"]);

    $query = "UPDATE pelanggan SET 
                nama_pelanggan = :nama_pelanggan,
                username = :username,
                password = :password,
                alamat_pelanggan = :alamat_pelanggan,
                no_hp_pelanggan = :no_hp_pelanggan
            WHERE id_pelanggan = :id_pelanggan";

    $statement = $conn->prepare($query);
    $statement->bindParam(':nama_pelanggan', $nama_pelanggan);
    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $password);
    $statement->bindParam(':alamat_pelanggan', $alamat_pelanggan);
    $statement->bindParam(':no_hp_pelanggan', $no_hp_pelanggan);
    $statement->bindParam(':id_pelanggan', $id_pelanggan);

    return $statement->execute();
}

