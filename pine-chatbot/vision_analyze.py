# vision_analyze.py
import sys
import cv2
import numpy as np

# Ambil path dari argumen
image_path = sys.argv[1]

# Load gambar
image = cv2.imread(image_path)
if image is None:
    print("❌ Gagal membaca gambar.")
    sys.exit(1)

# Resize agar ringan
image = cv2.resize(image, (300, 300))

# Ubah ke HSV untuk segmentasi warna pohon hijau (daun pinus)
hsv = cv2.cvtColor(image, cv2.COLOR_BGR2HSV)

# Rentang warna hijau (tweak sesuai kebutuhan)
lower = np.array([30, 40, 40])
upper = np.array([85, 255, 255])
mask = cv2.inRange(hsv, lower, upper)

# Hitung jumlah area hijau
green_area = cv2.countNonZero(mask)
total_area = image.shape[0] * image.shape[1]
persentase_hijau = (green_area / total_area) * 100

# Interpretasi sederhana
if persentase_hijau > 30:
    prediksi = "Kemungkinan besar pohon pinus ✅"
elif persentase_hijau > 10:
    prediksi = "Mungkin pohon, tapi bukan pinus spesifik ⚠️"
else:
    prediksi = "Kemungkinan bukan pohon pinus ❌"

# Output
print(f"🟢 Area Hijau: {persentase_hijau:.2f}%")
print(f"🔍 Prediksi Vision: {prediksi}")
