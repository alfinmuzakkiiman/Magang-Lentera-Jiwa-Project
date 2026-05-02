# 🚀 Magang PT Lentera Jiwa - POS Laravel Project

![Laravel](https://img.shields.io/badge/Laravel-Framework-red?style=for-the-badge\&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-Backend-blue?style=for-the-badge\&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange?style=for-the-badge\&logo=mysql)
![Status](https://img.shields.io/badge/Status-Completed-success?style=for-the-badge)

---

## 📌 Tentang Project

Project ini merupakan aplikasi **Point of Sale (POS)** berbasis web yang dikembangkan menggunakan **Laravel** selama kegiatan magang di **PT Lentera Jiwa**.

Sistem ini dirancang untuk membantu operasional penjualan dengan pembagian hak akses berdasarkan role:
**Admin, Kasir, dan Kitchen**.

---

## 👥 Role & Hak Akses

### 🔑 Admin

Admin memiliki kontrol penuh terhadap sistem:

* 📊 Dashboard:

  * Total Menu
  * Pendapatan Hari Ini
  * Total Order
  * Total Kasir
* 📦 Manajemen Menu (Tambah / Edit / Hapus)
* 💰 Melihat Pendapatan
* 🧾 Cetak Struk / Laporan
* 👤 Manajemen User (Tambah Kasir)

---

### 🛒 Kasir

Kasir bertugas melakukan transaksi:

* ➕ Menambahkan pesanan:

  * Makanan
  * Minuman
  * Snack
* 🧮 Checkout & Proses Pembayaran
* 🧾 Cetak Struk Transaksi

---

### 🍳 Kitchen

Kitchen menangani pesanan:

* 📋 Melihat daftar pesanan masuk
* ⏳ Update status:

  * **Waiting**
  * **Complete**
* 🔄 Status pesanan otomatis terhubung ke Admin

---

## ✨ Fitur Utama

* 🔐 Authentication & Role Management
* 📦 CRUD Menu
* 🛒 Sistem Transaksi POS
* 📊 Dashboard Statistik
* 🧾 Cetak Struk
* 🔄 Manajemen Status Pesanan (Kitchen)

---

## 🛠️ Teknologi yang Digunakan

* **Laravel**
* **PHP**
* **MySQL**
* **Bootstrap / Admin Template**
* **JavaScript**

---

## 📸 Preview Tampilan



---

## ⚙️ Cara Install & Menjalankan Project

### 1. Clone Repository

```bash
git clone https://github.com/alfinmuzakkiiman/Magang-Lentera-Jiwa-Project.git
```

### 2. Masuk ke Folder Project

```bash
cd Magang-Lentera-Jiwa-Project
```

### 3. Install Dependency

```bash
composer install
npm install
```

### 4. Copy File Environment

```bash
cp .env.example .env
```

### 5. Generate Key

```bash
php artisan key:generate
```

### 6. Setting Database (.env)

```env
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Migrasi Database

```bash
php artisan migrate
```

### 8. Jalankan Server

```bash
php artisan serve
```

Akses:

```
http://127.0.0.1:8000
```

---

## 🔐 Catatan Penting

* File `.env` tidak disertakan demi keamanan
* Pastikan database sudah dibuat sebelum migrate
* Gunakan versi PHP yang sesuai dengan Laravel

---

## 🎯 Tujuan Project

* Implementasi sistem POS berbasis Laravel
* Pembagian role user dalam sistem nyata
* Meningkatkan skill backend development

---

## 👨‍💻 Developer

**Alfin Muzakki Iman**

---

## ⭐ Dukungan

Jika project ini bermanfaat:

* ⭐ Star repo ini
* 🍴 Fork untuk pengembangan

---

## 📄 Lisensi

Project ini dibuat untuk keperluan pembelajaran dan portofolio.
