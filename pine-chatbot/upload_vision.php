<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['image'])) {
        echo "❌ Gagal: File tidak ditemukan.";
        exit;
    }

    $file = $_FILES['image'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file["name"]);

    // Validasi file gambar
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ['jpg', 'jpeg', 'png'];

    if (!in_array($file_type, $allowed_types)) {
        echo "❌ Hanya gambar JPG, JPEG, atau PNG yang diperbolehkan.";
        exit;
    }

    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        echo "✅ Gambar berhasil diunggah.<br>";

        // Jalankan script vision Python
        $escaped_path = escapeshellarg($target_file);
        $command = "python3 vision_analyze.py $escaped_path";
        $output = shell_exec($command);

        echo "<br>📷 <strong>Hasil Analisis Vision:</strong><br>";
        echo nl2br($output);
    } else {
        echo "❌ Gagal mengunggah file.";
    }
}
?>
