<div align="center">
  
# Manajemen Data Siswa SMKN 6 Surakarta

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![AdminLTE](https://img.shields.io/badge/AdminLTE-3C8DBC?style=for-the-badge&logo=bootstrap&logoColor=white)

### *Sistem Informasi Pengelolaan Data Siswa Berbasis Web* 🎓

[![GitHub forks](https://img.shields.io/github/forks/RizafiDev/ManajemenDataSiswa?style=for-the-badge&color=ff69b4)](https://github.com/RizafiDev/ManajemenDataSiswa/network)
[![GitHub stars](https://img.shields.io/github/stars/RizafiDev/ManajemenDataSiswa?style=for-the-badge&color=yellow)](https://github.com/RizafiDev/ManajemenDataSiswa/stargazers)
[![GitHub last commit](https://img.shields.io/github/last-commit/RizafiDev/ManajemenDataSiswa?style=for-the-badge&color=brightgreen)](https://github.com/RizafiDev/ManajemenDataSiswa/commits/main)
[![License](https://img.shields.io/github/license/RizafiDev/ManajemenDataSiswa?style=for-the-badge&color=blue)](LICENSE)

</div>

## 📋 Deskripsi Proyek

**Manajemen Data Siswa SMKN 6 Surakarta** adalah sistem informasi berbasis web yang dikembangkan khusus untuk mendukung pengelolaan data siswa dan informasi terkait di SMKN 6 Surakarta. Sistem ini dirancang dengan teknologi modern menggunakan framework Laravel dan template AdminLTE untuk memberikan pengalaman pengguna yang optimal dalam administrasi sekolah.

### 🎯 Latar Belakang

Dengan meningkatnya jumlah siswa dan kompleksitas data yang harus dikelola, seperti data pribadi, jurusan, agama, dan status keaktifan, metode pengelolaan manual menjadi kurang efisien dan rentan terhadap kesalahan. Aplikasi ini hadir sebagai solusi berbasis teknologi yang memungkinkan admin atau pengelola sekolah untuk menyimpan, mengedit, dan mengakses data siswa secara terstruktur dan real-time.

### 🎯 Tujuan Aplikasi

1. **📊 Pengelolaan Data Terpusat** - Menyediakan platform untuk menyimpan dan mengelola data siswa (NIS, NISN, nama, kelas, jurusan, agama, gender) secara terpusat dan terorganisir
2. **⚡ Efisiensi dan Akurasi** - Mengurangi kesalahan manual dengan fitur input data otomatis dan pencarian data yang cepat berdasarkan berbagai filter
3. **📈 Pelaporan dan Analisis** - Menyediakan visualisasi data berupa grafik (bar chart dan line chart) untuk memantau statistik siswa dan mendukung analisis sekolah
4. **🔐 Keamanan dan Akses** - Memastikan hanya pengguna yang berwenang dapat mengakses dan mengelola data melalui sistem autentikasi yang aman
5. **🖥️ Kemudahan Penggunaan** - Menawarkan antarmuka yang intuitif dengan fitur CRUD lengkap dan sistem pencarian yang powerful

## ✨ Fitur Utama

### 👥 **Manajemen Data Siswa**
- 📝 **Input Data Lengkap**: Form input komprehensif untuk data siswa (NIS, NISN, nama, kelas, jurusan, agama, gender)
- 🔍 **Pencarian & Filter**: Sistem pencarian canggih dengan filter berdasarkan kelas, jurusan, agama, dan gender
- ✏️ **Edit & Update**: Fitur edit data siswa dengan validasi input yang ketat
- 🗑️ **Hapus Data**: Penghapusan data dengan konfirmasi untuk mencegah kesalahan

### 📊 **Visualisasi & Pelaporan**
- 📈 **Dashboard Analytics**: Dashboard dengan statistik real-time jumlah siswa
- 📊 **Grafik Interaktif**: Bar chart dan line chart untuk analisis distribusi siswa
- 📋 **Laporan Komprehensif**: Generate laporan berdasarkan tahun, kelas, dan jurusan
- 🎯 **Insights Data**: Analisis distribusi gender dan statistik siswa per tahun

### 🔐 **Sistem Keamanan**
- 🛡️ **Autentikasi Admin**: Login system yang aman untuk administrator
- 👤 **Role Management**: Kontrol akses berdasarkan peran pengguna
- 🔒 **Session Security**: Pengelolaan sesi yang aman dengan timeout otomatis

### 🖥️ **User Interface**
- 🎨 **Modern UI/UX**: Interface yang clean dan responsif menggunakan AdminLTE
- 📱 **Responsive Design**: Dapat diakses dari berbagai perangkat (desktop, tablet, mobile)
- ⚡ **Fast Loading**: Optimasi performa untuk loading yang cepat

# 🌐 COBA WEBSITE : <a href="https://adminlte.rizafidev.site/register">KUNJUNGI</a>

## 🛠️ Tech Stack

<div align="center">

| 🚀 **Component** | 💎 **Technology** | 🎯 **Version** | 📝 **Purpose** |
|:---:|:---:|:---:|:---:|
| 🖥️ **Backend Framework** | ![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white) | 10.x | MVC Framework |
| 💻 **Programming Language** | ![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white) | 8.1+ | Server-side Logic |
| 🗄️ **Database** | ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white) | 8.0+ | Data Storage |
| 🎨 **Admin Template** | ![AdminLTE](https://img.shields.io/badge/AdminLTE-3C8DBC?style=flat-square&logo=bootstrap&logoColor=white) | 3.x | Admin Interface |
| 🎯 **Frontend** | ![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=flat-square&logo=bootstrap&logoColor=white) | 5.x | CSS Framework |
| 📊 **Charts** | ![Chart.js](https://img.shields.io/badge/Chart.js-FF6384?style=flat-square&logo=chartdotjs&logoColor=white) | 4.x | Data Visualization |
| 🔧 **Package Manager** | ![Composer](https://img.shields.io/badge/Composer-885630?style=flat-square&logo=composer&logoColor=white) | Latest | PHP Dependencies |

</div>

## 📊 Database Schema

### 📋 Tabel Siswa (students)
```sql
- id (Primary Key)
- nis (Nomor Induk Siswa)
- nisn (Nomor Induk Siswa Nasional)  
- nama_lengkap (Nama Lengkap Siswa)
- kelas (Kelas Siswa)
- jurusan (Program Keahlian)
- agama (Agama Siswa)
- jenis_kelamin (Gender)
- tahun_masuk (Tahun Masuk)
- status (Status Keaktifan)
- created_at / updated_at (Timestamps)
```

### 👤 Tabel Users (users)
```sql
- id (Primary Key)
- name (Nama Admin)
- email (Email Admin)
- password (Password Hash)
- role (Role User)
- created_at / updated_at (Timestamps)
```

## 🚀 Cara Instalasi & Setup

### Prerequisites
Pastikan sistem Anda telah menginstall:
- PHP 8.1 atau lebih tinggi
- Composer
- MySQL 8.0+
- Apache/Nginx Web Server
- Git

### 📥 Clone Repository

```bash
# 🚀 Clone repository
git clone https://github.com/RizafiDev/ManajemenDataSiswa.git

# 📁 Masuk ke direktori proyek
cd ManajemenDataSiswa
```

### 🔧 Installation Steps

1. **📦 Install Dependencies**
   ```bash
   # Install PHP dependencies
   composer install
   
   # Install Node.js dependencies (optional)
   npm install
   ```

2. **⚙️ Environment Configuration**
   ```bash
   # Copy environment file
   cp .env.example .env
   
   # Generate application key
   php artisan key:generate
   ```

3. **🗄️ Database Setup**
   ```bash
   # Edit .env file dengan konfigurasi database Anda
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=manajemen_siswa
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

4. **🏗️ Database Migration**
   ```bash
   # Jalankan migration untuk membuat tabel
   php artisan migrate
   
   # Jalankan seeder untuk data dummy (optional)
   php artisan db:seed
   ```

5. **🔐 Create Admin User**
   ```bash
   # Buat user admin pertama
   php artisan make:seeder AdminSeeder
   php artisan db:seed --class=AdminSeeder
   ```

6. **🚀 Run Application**
   ```bash
   # Jalankan development server
   php artisan serve
   
   # Akses aplikasi di: http://localhost:8000
   ```

### 🔧 Additional Configuration

**📊 Setup Chart.js (Optional)**
```bash
# Jika menggunakan npm untuk asset compilation
npm run dev

# Untuk production
npm run build
```

**🖼️ Storage Link**
```bash
# Buat symbolic link untuk storage (jika ada file upload)
php artisan storage:link
```

## 📚 Panduan Penggunaan

### 🔐 Login Administrator
1. Akses halaman login di `/login`
2. Masukkan kredensial admin yang telah dibuat
3. Setelah login berhasil, Anda akan diarahkan ke dashboard

### 👥 Mengelola Data Siswa
1. **Tambah Siswa Baru**: Klik tombol "Tambah Siswa" dan isi form lengkap
2. **Edit Data**: Klik icon edit pada tabel data siswa
3. **Hapus Data**: Klik icon hapus dengan konfirmasi
4. **Pencarian**: Gunakan fitur search dan filter untuk menemukan data spesifik

### 📊 Melihat Laporan
1. Akses menu "Laporan" di sidebar
2. Pilih filter berdasarkan tahun, kelas, atau jurusan
3. Lihat visualisasi data dalam bentuk grafik
4. Export laporan ke format PDF/Excel (jika tersedia)

## 🔒 Security Features

- ✅ **CSRF Protection**: Laravel built-in CSRF protection
- ✅ **SQL Injection Prevention**: Eloquent ORM protection
- ✅ **XSS Protection**: Input sanitization
- ✅ **Authentication**: Secure login system
- ✅ **Authorization**: Role-based access control
- ✅ **Password Hashing**: Bcrypt encryption

## 🚀 Performance Optimization

- ⚡ **Database Indexing**: Optimized database queries
- 🗃️ **Caching**: Laravel caching for better performance
- 📦 **Asset Minification**: Compressed CSS/JS files
- 🖼️ **Image Optimization**: Optimized image handling

## 🤝 Kontribusi

Kami sangat menghargai kontribusi dari komunitas! Untuk berkontribusi:

1. 🍴 Fork repository ini
2. 🌟 Buat branch fitur baru (`git checkout -b feature/AmazingFeature`)
3. 💬 Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. 🚀 Push ke branch (`git push origin feature/AmazingFeature`)
5. 📝 Buat Pull Request

### 📋 Guidelines Kontribusi
- Pastikan kode mengikuti PSR-12 coding standards
- Tulis unit tests untuk fitur baru
- Update dokumentasi jika diperlukan
- Gunakan commit message yang descriptive

## 🐛 Bug Reports & Feature Requests

Jika Anda menemukan bug atau ingin mengusulkan fitur baru:
1. Cek [Issues](https://github.com/RizafiDev/ManajemenDataSiswa/issues) yang sudah ada
2. Buat issue baru dengan template yang sesuai
3. Berikan deskripsi yang detail dan langkah reproduksi

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE) - lihat file LICENSE untuk detail lebih lanjut.

## 👨‍💻 Developer

**Firmansyah Riza Afifudin**
- 📧 Email: rizafidev@gmail.com
- 🐱 GitHub: [@RizafiDev](https://github.com/RizafiDev)
- 💼 LinkedIn: [Firmansyah Riza Afifudin](https://linkedin.com/in/firmansyah-riza-afifudin)

## 🙏 Acknowledgments

- 🏫 **SMKN 6 Surakarta** - Untuk kepercayaan dalam pengembangan sistem ini
- 🚀 **Laravel Team** - Framework yang powerful dan elegant
- 🎨 **AdminLTE Team** - Template admin yang beautiful dan responsive
- 💡 **Open Source Community** - Untuk tools dan library yang amazing

## 📞 Support & Bantuan

Butuh bantuan? Jangan ragu untuk menghubungi:
- 📧 **Email Support**: rizafidev@gmail.com
- 💬 **GitHub Issues**: [Create New Issue](https://github.com/RizafiDev/ManajemenDataSiswa/issues/new)
- 📖 **Documentation**: [Wiki Page](https://github.com/RizafiDev/ManajemenDataSiswa/wiki)

---

<div align="center">
  
### 🎓 Manajemen Data Siswa SMKN 6 Surakarta 🚀

*Digitalisasi Administrasi Sekolah untuk Masa Depan Pendidikan yang Lebih Baik*

[![GitHub](https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white)](https://github.com/RizafiDev/ManajemenDataSiswa)
[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)

**⭐ Jangan lupa beri star jika project ini bermanfaat! ⭐**

*Made with ❤️ for Education Technology*

</div>
