<?php
include_once('config/db.php');
include_once('views/layout.php');

// Ambil data history
$sql = "SELECT * FROM history ORDER BY tanggal DESC";
$result = $conn->query($sql);
?>

<div class="container mt-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">Riwayat Klasifikasi</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Lingkar Batang (m)</th>
                            <th>Tinggi (m)</th>
                            <th>Jenis Prediksi</th>
                            <th>Certainty Factor (%)</th>
                            <th>KNN Tetangga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($row['tanggal'])) ?></td>
                            <td><?= $row['lingkar_batang'] ?></td>
                            <td><?= $row['tinggi'] ?></td>
                            <td><strong><?= $row['jenis_prediksi'] ?></strong></td>
                            <td><?= round($row['nilai_cf'] * 100, 2) ?>%</td>
                            <td><?= $row['nilai_knn'] ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <a href="index.php" class="btn btn-outline-secondary mt-3">Kembali ke Prediksi</a>
        </div>
    </div>
</div>



<!-- Footer Section -->
<div class="container-fluid mt-5 text-center">
  <p>&copy;ADIL MAHENDRA - 2355201164 | Prediksi Pohon Pinus - UAS KNN Pinus 2025. </p>
</div>
</body>
</html>