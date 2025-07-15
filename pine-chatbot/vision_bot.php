<?php
// vision_bot.php
include_once('layout.php');
?>

<div class="container mt-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">🔍 Analisis Gambar Pohon Pinus</h4>
            <form action="vision_bot.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="image" class="form-label">Upload Gambar Pohon</label>
                    <input type="file" name="image" accept="image/*" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">🔎 Analisis Sekarang</button>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
                $upload_dir = __DIR__ . "/uploads/";
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                $file_tmp = $_FILES['image']['tmp_name'];
                $file_name = basename($_FILES['image']['name']);
                $target_path = $upload_dir . $file_name;

                if (move_uploaded_file($file_tmp, $target_path)) {
                    echo "<div class='alert alert-success mt-4'>✅ Gambar berhasil diunggah.</div>";

                    // Jalankan skrip Python vision_analyze.py
                    $escaped_path = escapeshellarg($target_path);
                    $command = "python vision_analyze.py $escaped_path";
                    $output = shell_exec($command);

                    echo "<h5 class='mt-4'>📷 Hasil Analisis Vision:</h5>";
                    echo "<pre class='bg-light p-3 rounded border'>$output</pre>";
                } else {
                    echo "<div class='alert alert-danger mt-4'>❌ Gagal mengunggah gambar.</div>";
                }
            }
            ?>
        </div>
    </div>
</div>
