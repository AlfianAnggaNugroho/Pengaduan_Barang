<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_finemine";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT status, COUNT(*) AS jumlah FROM pengaduan GROUP BY status";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'status' => $row['status'],
            'jumlah' => $row['jumlah']
        ];
    }

    echo json_encode($data);
} else {
    echo json_encode(['message' => 'No results']);
}


$conn->close();
?>