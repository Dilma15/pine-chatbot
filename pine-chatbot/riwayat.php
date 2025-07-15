<?php
include_once('config/db.php');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Prediksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">📋 Riwayat Prediksi Pohon Pinus</h2>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Lingkar Batang</th>
                <th>Tinggi</th>
                <th>Jenis Prediksi</th>
                <th>Nilai CF</th>
                <th>3 Terdekat (KNN)</th>
                <th>waktu</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM history ORDER BY tanggal DESC";
            $result = $conn->query($sql);
            $no = 1;

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$no}</td>";
                echo "<td>{$row['lingkar_batang']}</td>";
                echo "<td>{$row['tinggi']}</td>";
                echo "<td>{$row['jenis_prediksi']}</td>";
                echo "<td>" . round($row['nilai_cf'] * 100, 2) . "%</td>";
                echo "<td>{$row['nilai_knn']}</td>";
                echo "<td>{$row['tanggal']}</td>";
                echo "</tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-primary mt-3">🔙 Kembali ke Chat</a>
</div>

</body>
</html>



<!-- Footer Section -->
<div class="container-fluid mt-5 text-center">
  <p>&copy;ADIL MAHENDRA - 2355201164 | Prediksi Pohon Pinus - UAS KNN Pinus 2025. </p>
</div>
</body>
</html>