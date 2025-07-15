<?php include_once('config/db.php'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Chatbot Pohon Pinus</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
    }
    .chat-container {
      max-width: 700px;
      margin: 30px auto;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 20px;
      display: flex;
      flex-direction: column;
      height: 80vh;
    }
    .chat-box {
      flex: 1;
      overflow-y: auto;
      padding-bottom: 15px;
    }
    .bubble {
      max-width: 75%;
      padding: 12px 16px;
      border-radius: 20px;
      margin-bottom: 10px;
      word-wrap: break-word;
    }
    .user {
      align-self: flex-end;
      background-color: #d1e7dd;
      color: #0f5132;
      border-bottom-right-radius: 0;
    }
    .bot {
      align-self: flex-start;
      background-color: #e2e3e5;
      color: #000;
      border-bottom-left-radius: 0;
    }
    .input-area {
      display: flex;
      gap: 10px;
    }
    .form-control {
      border-radius: 20px;
    }
  </style>
</head>
<body>
<div class="chat-container">
  <div id="chatBox" class="chat-box">
    <div class="bubble bot">🌲 Halo! Saya adalah chatbot sistem pakar prediksi pohon pinus. Masukkan lingkar batang dan tinggi pohon. Contoh: <br><code>lingkar batang 0.3 dan tinggi 10.2</code></div>
  </div>

  <form id="chatForm" class="input-area mt-2">
    <input type="text" id="message" name="message" class="form-control" placeholder="Tulis pesan..." autocomplete="off" required>
    <button class="btn btn-success" type="submit">Kirim</button>
  </form>

  <form action="upload_vision.php" method="POST" enctype="multipart/form-data" class="mt-3">
    <div class="mb-3">
        <label for="image" class="form-label">Upload Gambar Pohon 🌲</label>
        <input type="file" name="image" accept="image/*" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-warning w-100">🔍 Analisis Gambar</button>
</form>

  <a href="riwayat.php" class="btn btn-outline-secondary mt-3">📜 Lihat Riwayat</a>
</div>

<script>
const chatForm = document.getElementById('chatForm');
const chatBox = document.getElementById('chatBox');
const messageInput = document.getElementById('message');

chatForm.addEventListener('submit', function(e) {
  e.preventDefault();
  const msg = messageInput.value.trim();
  if (msg === '') return;

  // Tambahkan bubble user
  chatBox.innerHTML += `<div class="bubble user">${msg}</div>`;
  chatBox.scrollTop = chatBox.scrollHeight;

  // Kosongkan input
  messageInput.value = '';

  // Kirim pesan ke server
  const formData = new FormData();
  formData.append('message', msg);

  fetch('chat_process.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.text())
  .then(res => {
    chatBox.innerHTML += `<div class="bubble bot">${res}</div>`;
    chatBox.scrollTop = chatBox.scrollHeight;
  });
});
</script>
</body>
</html>


<!-- Footer Section -->
<div class="container-fluid mt-5 text-center">
  <p>&copy;ADIL MAHENDRA - 2355201164 | Prediksi Pohon Pinus - UAS KNN Pinus 2025. </p>
</div>
</body>
</html>