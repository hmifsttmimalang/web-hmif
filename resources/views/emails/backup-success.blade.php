@component('mail::message')
# ✅ Backup Database Berhasil

📦 File backup database HMIF SMI Malang telah berhasil disimpan dan diunggah ke Google Drive.

@component('mail::button', ['url' => $url])
🔗 Lihat File Backup
@endcomponent

🕓 Waktu Backup: {{ now()->format('d M Y, H:i') }} WIB

---

Jika Anda tidak merasa membutuhkan email ini, abaikan saja.

Terima kasih,
**HMIF SMI Malang**

@endcomponent
