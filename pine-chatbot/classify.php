<?php
include_once('config/db.php');

// Ambil input dari form
$lingkar_batang = floatval($_POST['lingkar_batang']);
$tinggi = floatval($_POST['tinggi']);
$k = intval($_POST['k_value']);

// Ambil data training
$sql = "SELECT * FROM training_data";
$result = $conn->query($sql);

$data_training = [];

while ($row = $result->fetch_assoc()) {
    $jarak = sqrt(pow($row['lingkar_batang'] - $lingkar_batang, 2) + pow($row['tinggi'] - $tinggi, 2));
    $data_training[] = [
        'jarak' => $jarak,
        'jenis_pinus' => $row['jenis_pinus']
    ];
}

// Urutkan berdasarkan jarak terdekat
usort($data_training, function($a, $b) {
    return $a['jarak'] <=> $b['jarak'];
});

// Ambil K terdekat
$tetangga_terdekat = array_slice($data_training, 0, $k);

// Hitung jumlah vote tiap jenis pinus
$votes = [];
foreach ($tetangga_terdekat as $t) {
    $jenis = $t['jenis_pinus'];
    if (!isset($votes[$jenis])) $votes[$jenis] = 0;
    $votes[$jenis]++;
}

// Tentukan prediksi dari hasil voting
arsort($votes);
$jenis_prediksi = array_key_first($votes);

// Hitung Certainty Factor sederhana berdasarkan proporsi K
$nilai_cf = ($votes[$jenis_prediksi] / $k);

// Simpan riwayat ke database
$knn_string = implode(', ', array_map(fn($t) => $t['jenis_pinus'], $tetangga_terdekat));

$stmt = $conn->prepare("INSERT INTO history (lingkar_batang, tinggi, jenis_prediksi, nilai_cf, nilai_knn) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ddsss", $lingkar_batang, $tinggi, $jenis_prediksi, $nilai_cf, $knn_string);
$stmt->execute();

// Tampilkan hasil prediksi
?>

<?php include_once('views/layout.php'); ?>
<div class="container mt-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-body">
            <h4 class="card-title text-center">Hasil Prediksi</h4>
            <p class="mt-4">Lingkar Batang: <strong><?= $lingkar_batang ?> m</strong></p>
            <p>Tinggi Pohon: <strong><?= $tinggi ?> m</strong></p>
            <p>Nilai K: <strong><?= $k ?></strong></p>
            <hr>
            <h5 class="text-success">Jenis Pinus: <strong><?= $jenis_prediksi ?></strong></h5>
            <p>Certainty Factor: <strong><?= round($nilai_cf * 100, 2) ?>%</strong></p>
            <p>Data Tetangga K Terdekat: <?= $knn_string ?></p>
            <a href="views/form_input.php" class="btn btn-outline-primary mt-3">Coba Lagi</a>
        </div>
    </div>
</div>



<!-- Footer Section -->
<div class="container-fluid mt-5 text-center">
  <p>&copy;ADIL MAHENDRA - 2355201164 | Prediksi Pohon Pinus - UAS KNN Pinus 2025. </p>
</div>
</body>
</html>