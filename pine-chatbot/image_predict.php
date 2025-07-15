<?php include_once('layout.php'); ?>

<div class="container mt-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">Prediksi Jenis Pohon dari Gambar 🌲</h4>
            <form action="vision_predict.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="image" class="form-label">Unggah Foto Pohon</label>
                    <input type="file" name="image" accept="image/*" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">🔍 Prediksi dari Gambar</button>
                <a href="index.php" class="btn btn-secondary mt-2 w-100">⬅️ Kembali</a>
            </form>
        </div>
    </div>
</div>
