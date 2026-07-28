# sistem-iuran
Tugas Akhir
Sistem Informasi Iuran Berbasis Website dirancang untuk mendigitalisasi dan memmodernisasi pengelolaan keuangan lingkungan di Perumahan Bumi Agung Permai (meliputi 4 RT dan 180 warga aktif). Aplikasi ini hadir sebagai solusi atas permasalahan inefisiensi pada metode penagihan konvensional secara *door-to-door* dan pencatatan fisik yang rentan mengalami tunggakan pembayaran, serta keterbatasan waktu akibat mobilitas warga yang tinggi.

---

**Deskripsi Proyek**
Proyek ini menyediakan platform terpadu yang menghubungkan warga dan bendahara secara digital untuk pengelolaan dua jenis alokasi iuran bulanan (Rp25.000/bulan dengan jatuh tempo tanggal 20), yaitu **Iuran Keamanan (Rp21.000)** dan **Kas Warga (Rp4.000)**. 

Melalui sistem ini, warga dapat memantau tagihan, melakukan pembayaran otomatis tanpa unggah bukti transfer, serta melihat riwayat transaksi secara transparan. Bendahara dapat mengelola rekapitulasi pembayaran serta mendistribusikan notifikasi pengingat pembayaran langsung ke WhatsApp warga.

---

**Fitur Utama**
- **Autentikasi & Akun Personal:** Registrasi individu untuk warga dan login untuk bendahara, ketua RT, dan ketua RW.
- **Integrasi Payment Gateway (Midtrans):** Verifikasi pembayaran otomatis secara *real-time* via *virtual account*, *e-wallet*, dan kanal pembayaran digital lainnya.
- **Notifikasi WhatsApp:** Pengiriman pesan notifikasi tagihan dan konfirmasi pembayaran dengan tingkat keterbacaan tinggi.
- **Rekapitulasi & Laporan Keuangan:** Pemantauan status tunggakan, riwayat transaksi.

---

**Petunjuk Cara Instalasi**

### 1. Persiapan Lingkungan Server (*Environment*)
- Pastikan komputer atau server lokal telah terpasang aplikasi web server (seperti **XAMPP** atau **Laragon**) yang menyediakan **PHP** dan **MySQL**.
- Jalankan modul **Apache** dan **MySQL** melalui panel kontrol web server.

### 2. Penempatan Berkas Proyek
- Unduh atau klon (*clone*) repositori ini ke dalam direktori utama web server lokal:
  - Untuk XAMPP: `C:/xampp/htdocs/sistem-iuran

### 3. Konfigurasi Basis Data (*Database*)
- Buka peramban (*web browser*) dan akses `http://localhost/phpmyadmin`.
- Buat basis data baru bernama `db_iuran_bap`.
- Pilih menu **Import**, lalu pilih berkas `database/db_iuran_bap.sql` yang tersedia dalam direktori proyek, kemudian klik **Go/Kirim**.

### 4. Pengaturan Berkas Konfigurasi (`.env` / `config.php`)
- Buka berkas konfigurasi sistem (seperti `.env` atau `config/database.php`).
- Sesuaikan kredensial basis data MySQL (nama database, *username*, dan *password*).
- Masukkan kredensial **Midtrans** (*Server Key* dan *Client Key*) untuk mengaktifkan pemrosesan pembayaran otomatis.
- Masukkan kredensial API **WhatsApp** (*API Key* / *Token*) untuk mengaktifkan layanan notifikasi pesan.

---

**Evaluasi & Pengujian**
- **Black Box Testing:** Pengujian fungsionalitas sistem untuk memastikan seluruh fitur berjalan sesuai kebutuhan.
- **System Usability Scale (SUS):** Evaluasi tingkat kepuasan dan kemudahan penggunaan sistem oleh warga dan pengurus.

---

**Daftar Kontributor**

Penelitian dan pengembangan Sistem Informasi Iuran Berbasis Website ini disusun dan dikembangkan oleh:

- **Pengembang Utama / Peneliti:** Tim Tugas Akhir Pengembangan Sistem Informasi Perumahan Bumi Agung Permai.
- **Dosen Pembimbing:** Tim Dosen Pembimbing Tugas Akhir.
- **Mitra Lapangan & Narasumber:** Pengurus RT/RW dan Bendahara Perumahan Bumi Agung Permai.
