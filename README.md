# Sistem-Terdistribusi-UAS

## Hubungkan dua Laptop Melalui Wifi

Jika Anda ingin menghubungkan dua laptop menggunakan hotspot dari ponsel, caranya cukup sederhana. Berikut adalah langkah-langkah untuk menghubungkannya:

1. Mengaktifkan Hotspot di Ponsel
Buka pengaturan ponsel, cari Hotspot Seluler atau Tethering, lalu aktifkan Hotspot.
Pastikan Anda mengatur Nama Hotspot (SSID) dan Kata Sandi agar laptop dapat terhubung.
2. Menghubungkan Kedua Laptop ke Hotspot
Di masing-masing laptop, cari nama hotspot ponsel Anda dalam daftar jaringan Wi-Fi, kemudian hubungkan dengan memasukkan kata sandi yang sudah ditentukan.
Setelah terhubung, kedua laptop kini berada dalam jaringan yang sama, yang memungkinkan mereka untuk saling terhubung.
3. Menentukan Peran Laptop sebagai Server dan Client
Pilih salah satu laptop sebagai server dan yang lainnya sebagai client.
Server akan menjalankan aplikasi backend atau API yang akan menyediakan data bagi client.
4. Menjalankan Server di Laptop Server
Di laptop server, jalankan backend aplikasi.

5. Mengetahui Alamat IP Server
Di laptop yang berperan sebagai server, buka Command Prompt atau Terminal dan ketik:
bash
Copy code
## Windows
`ipconfig`

Cari alamat IPv4 Address dari adapter jaringan yang terhubung ke hotspot ponsel. Misalnya, IP yang muncul bisa berupa 192.168.43.10 (alamat ini mungkin bervariasi tergantung pada ponsel dan jaringan).

6. Mengakses Server dari Laptop Client
Di laptop client, buka aplikasi client Anda dan gunakan IP server yang ditemukan di langkah sebelumnya.

7. Catatan Firewall (Jika Diperlukan)
Jika laptop client mengalami masalah akses ke server, periksa pengaturan firewall di laptop server untuk memastikan port yang digunakan (misalnya 5000) tidak diblokir.
Untuk pengujian awal, Anda bisa mematikan firewall sementara, lalu cek apakah client bisa terhubung ke server.

## Struktur Database
![Uploading image.png…]()


## Struktur Tabel
### Tabel Students: Menyimpan informasi dasar tentang siswa.

Fields:

student_id (Primary Key): ID unik untuk setiap siswa.

name: Nama siswa.

class: Kelas siswa.

contact: Informasi kontak siswa (misalnya nomor telepon atau email).

birth_date: Tanggal lahir siswa.

### Tabel Activities: Menyimpan informasi tentang kegiatan ekstrakurikuler.

Fields:

activity_id (Primary Key): ID unik untuk setiap kegiatan.

name: Nama kegiatan ekstrakurikuler.

description: Deskripsi singkat tentang kegiatan.

schedule: Jadwal kegiatan (misalnya hari atau waktu).

instructor: Nama instruktur atau pembimbing kegiatan.

### Tabel Registrations: Menyimpan data pendaftaran siswa ke kegiatan ekstrakurikuler.

Fields:

registration_id (Primary Key): ID unik untuk setiap pendaftaran.

student_id (Foreign Key): Menghubungkan pendaftaran dengan tabel Students.

activity_id (Foreign Key): Menghubungkan pendaftaran dengan tabel Activities.

registration_date: Tanggal pendaftaran siswa ke kegiatan.

status: Status pendaftaran (misalnya "aktif" atau "non-aktif").

### Tabel Attendance: Menyimpan catatan kehadiran siswa pada kegiatan ekstrakurikuler.

Fields:

attendance_id (Primary Key): ID unik untuk setiap catatan kehadiran.

student_id (Foreign Key): Menghubungkan kehadiran dengan tabel Students.

activity_id (Foreign Key): Menghubungkan kehadiran dengan tabel Activities.

attendance_date: Tanggal kehadiran siswa pada kegiatan.

status: Status kehadiran (misalnya "hadir" atau "tidak hadir").

## Relasi Antar Tabel
### Relasi Students ke Registrations: 
Relasi one-to-many (satu ke banyak), karena satu siswa dapat mendaftar ke banyak kegiatan. Kolom student_id di tabel Registrations adalah Foreign Key yang menghubungkan setiap pendaftaran dengan siswa tertentu di tabel Students.

### Relasi Activities ke Registrations: 
Relasi one-to-many (satu ke banyak), karena satu kegiatan dapat memiliki banyak siswa yang mendaftar. Kolom activity_id di tabel Registrations adalah Foreign Key yang menghubungkan setiap pendaftaran dengan kegiatan tertentu di tabel Activities.

### Relasi Students ke Attendance: 
Relasi one-to-many (satu ke banyak), karena satu siswa dapat memiliki banyak catatan kehadiran pada kegiatan yang berbeda. Kolom student_id di tabel Attendance adalah Foreign Key yang menghubungkan setiap catatan kehadiran dengan siswa di tabel Students.

### Relasi Activities ke Attendance: 
Relasi one-to-many (satu ke banyak), karena satu kegiatan dapat memiliki banyak catatan kehadiran dari siswa yang berbeda. Kolom activity_id di tabel Attendance adalah Foreign Key yang menghubungkan setiap catatan kehadiran dengan kegiatan di tabel Activities.

## Laptop Server (Backend)

Menyiapkan Server PHP - Jalankan XAMPP/WAMP untuk server.php dan Database.php.
Endpoint RESTful di server.php - Buat API CRUD untuk operasi siswa, kegiatan, pendaftaran, dan kehadiran.
Koneksi Database di Database.php - Buat fungsi CRUD dan relasi tabel di phpMyAdmin.
Konfigurasi Jaringan - Atur IP server dan pastikan akses client.

## Laptop Client (Frontend)

Antarmuka di index.php - Buat form HTML untuk pendaftaran dan jadwal.
Proses Data di proses.php - Teruskan input pengguna ke server via Client.php.
Client.php untuk Permintaan ke Server - Gunakan cURL untuk mengirim data ke server.
Pengujian dan Tampilkan Data - Tampilkan hasil respons dari server di halaman client.
