<p align="center">
  <img src="https://yourdomain.com/images/logo.png" alt="TanggapiKita" width="200"/>
</p>

<h2 align="center">TanggapiKita</h2>
<p align="center">Website Responsif untuk Informasi dan Laporan Bencana Real-Time</p>

<p align="center">
  <a href="#fitur">Fitur</a> •
  <a href="#instalasi">Instalasi</a> •
  <a href="#teknologi">Teknologi</a> •
  <a href="#kontribusi">Kontribusi</a>
</p>

---

## ✨ Fitur

- 📋 Laporan bencana langsung dari masyarakat
- 🧾 Riwayat donasi dengan integrasi Midtrans
- 📷 Upload foto profil pengguna dan admin
- 📊 Dashboard admin lengkap dengan manajemen data
- 🔐 Autentikasi pengguna & admin dengan pembagian akses
- 📦 CRUD untuk laporan, donasi, edukasi, dan informasi

---

## 🚀 Instalasi

```bash
git clone https://github.com/username/tanggapikita.git
cd tanggapikita
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
