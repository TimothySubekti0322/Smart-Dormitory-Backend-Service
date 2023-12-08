# Smart-Dormitory-Backend-Service

Selamat datang di repositori GitHub untuk Layanan Backend SMART DORMITORY. Proyek ini merupakan solusi web yang komprehensif untuk sebuah asrama yang menyediakan pemesanan catering. Aplikasi ini menerapkan struktur REST dalam pengembangan aplikasinya. Selain itu, Aplikasi yang kami tawarkan dibangun secara intuitif bagi pelanggan untuk menjelajahi layanan tambahan yang diberikan oleh pihak asrama.

### Aplikasi web ini dibuat oleh Kelompok 10 K01. Berikut adalah anggota kelompok kami :

```
1. Nadira R A- 18221059
2. Timothy Subekti - 18221063
3. Nadine Aliya Putri - 18221081
4. Carissa Zahrani Putri - 18221093
5. Benyamin Jodi Sitinjak - 18221147
```


## Fitur

### Penghuni Asrama

- **Login**: Akses yang aman dan terenkripsi untuk setiap penghuni asrama, memastikan privasi dan keamanan data.

- **Membeli Paket**: Penghuni dapat memilih paket untuk menambahkan kuota catering yang sesuai dengan kebutuhan dan preferensi mereka.

- **Melihat Daftar Menu**: Daftar lengkap menu catering yang tersedia dengan informasi rinci untuk membantu penghuni membuat pilihan yang tepat.

- **Membeli Makanan**: Penghuni dapat dengan mudah memesan makanan melalui aplikasi.

- **Melihat Riwayat Pembelian**: Akses cepat ke riwayat pembelian memberikan penghuni informasi lengkap tentang pesanan sebelumnya.

### Pihak Catering

- **Melihat Daftar Order**: Pantau dan kelola semua pesanan yang masuk dengan mudah.

- **Menambahkan Menu**: Tambahkan dan kelola menu catering dengan mudah, memastikan bahwa daftar selalu terkini dan relevan.

- **Melihat Daftar Pesanan Berdasarkan Tanggal dan Kategori**: Filter dan analisis pesanan berdasarkan tanggal dan kategori, memberikan wawasan yang berguna untuk perencanaan dan pengelolaan inventaris.
## Tech Stack

**Framework :** CodeIgniter 4

**Web Server :** XAMPP

**Database :** MySQL

**Testing Tools :** Postman
## Prasyarat

Sebelum memulai, pastikan Anda telah mendownload beberapa tools berikut ini:

- **XAMPP** : Pastikan Anda telah menginstal XAMPP untuk menyediakan lingkungan pengembangan lokal yang mencakup Apache, MySQL, PHP, dan Perl.
- **Composer** : Composer digunakan untuk mengelola dependensi PHP pada proyek. Pastikan Anda telah menginstal Composer sebelum melanjutkan dengan instalasi.

Untuk prasyatar ini anda dapat menggunakan referensi video berikut ini [Instalasi CodeIgniter 4](https://youtu.be/UhpzEne6omo?si=RTYhK_HoLrGbvm8f).

## Instalasi

Berikut adalah petunjuk instalasi program untuk menjalankan service pada mesin lokal

Pertama-tama, Anda perlu mengkloning proyek ini atau **mengunduh file**

```bash
  git clone https://github.com/TimothySubekti0322/Smart-Dormitory-Backend-Service.git
```

Pindah ke direktori proyek

```bash
  cd Path/to/Smart-Dormitory-Backend-Service
```

Kemudian instal semua dependensi dengan menjalankan kode ini pada terminal

```bash
  composer install
```

Selanjutnya, nyalakan XAMPP anda, Start Apache dan MySQL. 

![xampp control panel](https://res.cloudinary.com/djkckue0o/image/upload/v1702023164/README%20LSTI/dznhrgrwtsgopfm1g20o.png)

Lalu buka php myadmin melalui url "localhost:XXXX" dengan (XXXX) sebagai Port dari Apache. Dalam contoh gambar saya diatas maka saya akan memasukan url "localhost:8040" ke website. Kemudian setelah muncul welcome page XAMPP, klik menu phpMyAdmin pada top navbarnya. Kemudian buatlah sebuah database bernama **smart_dormitory**.

![Create database smart_dormitoyr](https://res.cloudinary.com/djkckue0o/image/upload/v1702023678/README%20LSTI/sasw53gtedj80yrkwszp.jpg)

Selanjutnya, buka kembali IDE anda. didalam project Smart-Dormitory-Backend-Service, buatlah sebuah file .env yang berisi koneksi URL Basis Data Anda dan JWT SECRET pribadi Anda. Salin kode di bawah ini, tempelkan kode dibawah ini pada file .env Anda

```bash
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'
database.default.hostname = localhost
database.default.database = smart_dormitory
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306
```
kemudian tambahkan Juga kode dibawah ini, dan ubahlah **ISI_DENGAN_JWT_KEY_AND** dengan JWT Key anda (Sangat Dibebaskan)

```bash
JWT_SECRET = ISI_DENGAN_JWT_KEY_Anda
```

**Sebagai contoh**

```bash
JWT_SECRET = a2TA7NgqFgsIifvPQgds+4fgjCOQl7rFH8BFg7rB2Oo=
```
![.env file](https://res.cloudinary.com/djkckue0o/image/upload/v1702024760/README%20LSTI/sc2bzxztc52zqwovmuw6.png)

Selanjutnya, jalankan command migrasi di bawah ini untuk membuat tabel pada database

```bash
  php spark migrate
```

![migration](https://res.cloudinary.com/djkckue0o/image/upload/v1702032125/README%20LSTI/y4xby2hv35jtwrdrxd7c.png)

Kemudian jalan kan command ini pada terminal untuk mengisi initial data pada tabel (seeding)
```bash
   php spark db:seed DbSeeder
```
![db seed](https://res.cloudinary.com/djkckue0o/image/upload/v1702032125/README%20LSTI/jib5r20etueewlerej1f.png)

Selanjutnya, ketik command di bawah ini untuk menjalankan server

```bash
  php spark serve
```

Sekarang anda bisa mengakses layanan backend Smart Dormitory melalui server http://localhost:8080/

#### NOTE
Jika Mengalami Kendala tidak bisa terkonek ke database, maka git Clone project Smart-Dormitory-Backend-Service ke dalam folder htdocs dengan path C:\xampp\htdocs

Error Yang mungkin terjadi adalah Port Conflict. berikut adalah link referensinya https://www.inforbiro.com/blog/how-to-change-xampp-apache-port

## Referensi API

Berikut adalah panduan API untuk Layanan Backend Smart Dormitory

https://docs.google.com/document/d/1VlchI6S-bMMoskiUUFWdnCSM9Ytj3aPmP2yKrLZXXsg/edit


## Test dengan POSTMAN

Berikut adalah panduan untuk melakukan testing API dengan POSTMAN

**LINK POSTMAN COLLECTION :**  https://drive.google.com/file/d/1FVK3k-NqFiD6IcuJC_2dkTxutz-iFuor/view?usp=sharing

**LINK PANDUAN TESTING DENGAN POSTMAN :** https://youtu.be/i0QnpgYVLBM
## Deployment

**Frontend Link Deployment :**

**Backend Link Deployment :** https://smart-dormitory-backend-service.000webhostapp.com/


## Appendix

**Dokument Tubes K01 - Kelompok 10 :** https://docs.google.com/document/d/1DiBsWP7m1_Q6cDPY4BMPTH5Q0Aa-5d3TK5JKZdlwDSo/edit?usp=sharing

**PPT Tubes K01 - Kelompok 10 :** https://drive.google.com/file/d/1cgUsK8HA0IvIWQNXnKMXUUb7LDzeaD6N/view?usp=sharing