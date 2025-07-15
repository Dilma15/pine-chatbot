<?php include_once('views/layout.php'); ?>

<div class="container py-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-body text-center">
            <h3 class="mb-4">🌲 Sistem Pakar Prediksi Jenis Pohon Pinus</h3>
            <p>Pilih mode interaksi untuk memulai prediksi jenis pohon pinus:</p>
            <a href="views/form_input.php" class="btn btn-outline-primary btn-lg m-2">Form Manual</a>
            <a href="chat.php" class="btn btn-success btn-lg m-2">Mode Chatbot 🤖</a>
            <form action="upload_vision.php" method="POST" enctype="multipart/form-data" class="mt-3">
            <div class="mb-3">
            <label for="image" class="form-label">Upload Gambar Pohon 🌲</label>
            <input type="file" name="image" accept="image/*" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning w-100">🔍 Analisis Gambar</button>
            </form>
        </div>
    </div>
</div>

<!-- Footer Section -->
<div class="container-fluid mt-5 text-center">
  <p>&copy;ADIL MAHENDRA - 2355201164 | Prediksi Pohon Pinus - UAS KNN Pinus 2025. </p>
</div>
</body>
</html>