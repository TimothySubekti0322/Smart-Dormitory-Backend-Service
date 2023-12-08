# Smart-Dormitory-Backend-Service

Selamat datang di repositori GitHub untuk aplikasi web SMART DORMITORY. Proyek ini merupakan solusi web yang komprehensif untuk sebuah asrama yang menyediakan pemesanan catering. Aplikasi kami menawarkan antarmuka yang intuitif bagi pelanggan untuk menjelajahi layanan tambahan yang diberikan oleh pihak asrama.

### Aplikasi web ini dibuat oleh Kelompok 10 K01. Berikut adalah anggota kelompok kami :

```
1. Benyamin Jodi Sitinjak - 18221147
2. Nadira R A- 18221059
3. Timothy Subekti - 18221063
4. Nadine Aliya Putri - 18221081
5. Carissa Zahrani Putri - 18221093
```

## Fitur

### Penghuni Asrama

- **Login**: Akses yang aman dan terenkripsi untuk setiap penghuni asrama, memastikan privasi dan keamanan data.

- **Membeli Paket**: Penghuni dapat memilih paket catering yang sesuai dengan kebutuhan dan preferensi mereka.

- **Menambah Kuota**: Penghuni dapat menambahkan kuota makanan, memungkinkan penghuni untuk menyesuaikan pesanan mereka sesuai dengan kebutuhan harian.

- **Melihat Daftar Menu**: Daftar lengkap menu catering yang tersedia dengan informasi rinci untuk membantu penghuni membuat pilihan yang tepat.

- **Membeli Makanan**: Penghuni dapat dengan mudah memesan makanan tambahan atau mengubah pesanan mereka melalui antarmuka.

- **Melihat Riwayat Pembelian**: Akses cepat ke riwayat pembelian memberikan penghuni informasi lengkap tentang pesanan sebelumnya.

### Pihak Dormitory

- **Melihat Daftar Order**: Pantau dan kelola semua pesanan yang masuk dengan mudah.

- **Menambahkan Menu**: Tambahkan dan kelola menu catering dengan mudah, memastikan bahwa daftar selalu terkini dan relevan.

- **Melihat Daftar Pesanan Berdasarkan Tanggal dan Kategori**: Filter dan analisis pesanan berdasarkan tanggal dan kategori, memberikan wawasan yang berguna untuk perencanaan dan pengelolaan inventaris.

## Tech Stack

**Framework:** CodeIgniter 4

**Database:** MySQL

**Testing:** Postman

## Prasyarat

Sebelum memulai, pastikan Anda telah memenuhi persyaratan berikut ini:

- **XAMPP** : Pastikan Anda telah menginstal XAMPP untuk menyediakan lingkungan pengembangan lokal yang mencakup Apache, MySQL, PHP, dan Perl.
- **Composer** : Composer digunakan untuk mengelola dependensi PHP pada proyek. Pastikan Anda telah menginstal Composer sebelum melanjutkan dengan instalasi.

Untuk prerequisites anda dapat menggunakan referensi video berikut ini [Instalasi CodeIgniter 4](https://youtu.be/UhpzEne6omo?si=RTYhK_HoLrGbvm8f).

## Instalasi

Berikut adalah petunjuk penggunaan program

Pertama-tama, Anda perlu mengkloning proyek ini atau **mengunduh file**

```bash
  git clone https://github.com/TimothySubekti0322/Smart-Dormitory-Backend-Service.git
```

Pindah ke direktori proyek

```bash
  cd Path/to/Smart-Dormitory-Backend-Service
```

Kemudian instal semua dependensi dengan hanya menjalankan kode ini pada terminal

```bash
  composer install
```

Selanjutnya, nyalakan XAMPP anda, Start Apache dan MySQL. Lalu buka php myadmin dan buatlah sebuah database bernama **smart_dormitory**.

Selanjutnya, buatlah sebuah file .env yang berisi koneksi URL Basis Data Anda dan JWT SECRET pribadi Anda. Salin kode di bawah ini, tempelkan pada file .env Anda, ubah

```bash
database.default.hostname = localhost
database.default.database = smart_dormitory
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306

JWT_SECRET = ISI DENGAN JWT Anda

Contoh :
JWT_SECRET = a2TA7NgqFgsIifvPQgds+4fgjCOQl7rFH8BFg7rB2Oo=
```

Selanjutnya, jalankan command migrasi di bawah ini untuk membuat tabel pada database

```bash
  php spark migrate
```

Selanjutnya, ketik command di bawah ini untuk menjalankan server

```bash
  php spark serve
```

Sekarang anda bisa mengakses melalui server http://localhost:8080/

## Deployment

## Dokumen
