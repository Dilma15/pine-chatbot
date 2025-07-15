<?php
include_once('layout.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $uploadDir = 'uploads/';
    $filename = basename($_FILES['image']['name']);
    $targetPath = $uploadDir . $filename;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
        // Analisis warna dasar (sederhana)
        $im = imagecreatefromjpeg($targetPath);
        $w = imagesx($im);
        $h = imagesy($im);

        $rTotal = $gTotal = $bTotal = 0;
        $sampleCount = 0;

        for ($x = 0; $x < $w; $x += 10) {
            for ($y = 0; $y < $h; $y += 10) {
                $rgb = imagecolorat($im, $x, $y);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;

                $rTotal += $r;
                $gTotal += $g;
                $bTotal += $b;
                $sampleCount++;
            }
        }

        $avgR = $rTotal / $sampleCount;
        $avgG = $gTotal / $sampleCount;
        $avgB = $bTotal / $sampleCount;

        // Dummy rules klasifikasi berdasarkan proporsi warna hijau
        if ($avgG > $avgR && $avgG > $avgB) {
            $jenis = "White Pine";
        } elseif ($avgR > $avgG) {
            $jenis = "Red Pine";
        } else {
            $jenis = "Black Pine";
        }

        echo "<div class='container mt-5'>";
        echo "<div class='card shadow rounded-4'>";
        echo "<div class='card-body'>";
        echo "<h4 class='card-title text-center'>📸 Hasil Analisis Gambar</h4>";
        echo "<img src='$targetPath' class='img-fluid rounded mb-3'>";
        echo "<p><strong>Prediksi Jenis Pohon:</strong> $jenis</p>";
        echo "<p><strong>Warna Dominan (RGB):</strong> " . round($avgR) . ", " . round($avgG) . ", " . round($avgB) . "</p>";
        echo "<a href='image_predict.php' class='btn btn-secondary'>⬅️ Coba Gambar Lain</a>";
        echo "</div></div></div>";
    } else {
        echo "<div class='alert alert-danger'>Gagal mengunggah gambar.</div>";
    }
} else {
    echo "<div class='alert alert-warning'>Tidak ada gambar yang diproses.</div>";
}
?>
