<?php
require_once('../conn.php');

try {
    $query = "SELECT id_pelanggan, password FROM pelanggan";
    $statement = $conn->prepare($query);
    $statement->execute();

    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $hashedPassword = password_hash($row['password'], PASSWORD_DEFAULT);
        $updateQuery = "UPDATE pelanggan SET password = :password WHERE id_pelanggan = :id_pelanggan";
        $updateStatement = $conn->prepare($updateQuery);
        $updateStatement->bindParam(':password', $hashedPassword);
        $updateStatement->bindParam(':id_pelanggan', $row['id_pelanggan']);
        $updateStatement->execute();
    }
    echo "Passwords have been hashed.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
