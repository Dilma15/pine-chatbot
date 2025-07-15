<?php include_once('../config/db.php'); ?>
<?php include_once('layout.php'); ?>

<div class="container mt-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">Prediksi Jenis Pohon Pinus</h4>
            <form action="../classify.php" method="POST">
                <div class="mb-3">
                    <label for="lingkar_batang" class="form-label">Lingkar Batang (m)</label>
                    <input type="number" name="lingkar_batang" step="0.01" min="0" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="tinggi" class="form-label">Tinggi Pohon (m)</label>
                    <input type="number" name="tinggi" step="0.01" min="0" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="k_value" class="form-label">Nilai K (KNN)</label>
                    <input type="number" name="k_value" min="1" max="10" class="form-control" value="3" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Prediksi Sekarang</button>
                <a href="../riwayat.php" class="btn btn-secondary mt-3 w-100">📜 Lihat Riwayat</a>
                <a href="../chat.php" class="btn btn-success w-100 mt-2">Coba Mode Chatbot 🤖</a>
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