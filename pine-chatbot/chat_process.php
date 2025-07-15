<?php
// Tangkap pesan user
$pesan = strtolower(trim($_POST['message'] ?? ''));

// Jika user menyapa
if (in_array($pesan, ['halo', 'hi', 'hai', 'hello'])) {
    echo "🌲 Halo! Saya adalah chatbot sistem pakar prediksi pohon pinus. Masukkan lingkar batang dan tinggi pohon. Contoh:<br><code>lingkar batang 0.3 dan tinggi 10.2</code>";
    exit;
}

// Ekstrak angka dari kalimat
preg_match_all('/(\d+(\.\d+)?)/', $pesan, $matches);
$angka = $matches[0];

if (count($angka) < 2) {
    echo "⚠️ Tolong masukkan *dua angka*, contoh: <br><code>lingkar batang 0.3 dan tinggi 10.2</code>";
    exit;
}

// Koneksi ke database
include_once('config/db.php');

$lingkar_batang = floatval($angka[0]);
$tinggi = floatval($angka[1]);
$k = 3;

// Ambil data training dari database
$sql = "SELECT * FROM training_data";
$result = $conn->query($sql);

$data_training = [];
while ($row = $result->fetch_assoc()) {
    // Hitung jarak Euclidean
    $jarak = sqrt(pow($row['lingkar_batang'] - $lingkar_batang, 2) + pow($row['tinggi'] - $tinggi, 2));
    
    // Hitung rata-rata CF
    $cf_lingkar = isset($row['cf_lingkar']) ? floatval($row['cf_lingkar']) : 0;
    $cf_tinggi = isset($row['cf_tinggi']) ? floatval($row['cf_tinggi']) : 0;
    $cf = ($cf_lingkar + $cf_tinggi) / 2;

    $data_training[] = [
        'jarak' => $jarak,
        'jenis_pinus' => $row['jenis_pinus'],
        'cf' => $cf
    ];
}

if (empty($data_training)) {
    echo "❌ Data training kosong. Silakan tambahkan data pohon ke database.";
    exit;
}

// Urutkan berdasarkan jarak terdekat
usort($data_training, fn($a, $b) => $a['jarak'] <=> $b['jarak']);
$tetangga = array_slice($data_training, 0, $k);

// Voting dan perhitungan CF
$votes = [];
$cf_votes = [];
foreach ($tetangga as $t) {
    $jenis = $t['jenis_pinus'];
    $votes[$jenis] = ($votes[$jenis] ?? 0) + 1;
    $cf_votes[$jenis][] = $t['cf'];
}

arsort($votes);
$jenis_prediksi = array_key_first($votes);

// Hitung rata-rata CF dari jenis terpilih
$nilai_cf = 0;
if (!empty($cf_votes[$jenis_prediksi])) {
    $nilai_cf = array_sum($cf_votes[$jenis_prediksi]) / count($cf_votes[$jenis_prediksi]);
}

// Simpan riwayat
$knn_string = implode(', ', array_map(fn($t) => $t['jenis_pinus'], $tetangga));
$stmt = $conn->prepare("INSERT INTO history (lingkar_batang, tinggi, jenis_prediksi, nilai_cf, nilai_knn) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ddsss", $lingkar_batang, $tinggi, $jenis_prediksi, $nilai_cf, $knn_string);
$stmt->execute();

// Balasan bot
echo "📊 Saya memprediksi jenis pohon ini adalah <strong>$jenis_prediksi</strong><br>dengan tingkat keyakinan <strong>" . round($nilai_cf * 100, 2) . "%</strong>.";
