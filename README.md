# Sistem-Terdistribusi-UAS

# Hubungkan dua Laptop Melalui Wifi

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
Di laptop server, jalankan backend aplikasi Anda (misalnya, Flask, Django, atau Node.js).

5. Mengetahui Alamat IP Server
Di laptop yang berperan sebagai server, buka Command Prompt atau Terminal dan ketik:
bash
Copy code
# Windows
ipconfig

Cari alamat IPv4 Address dari adapter jaringan yang terhubung ke hotspot ponsel. Misalnya, IP yang muncul bisa berupa 192.168.43.10 (alamat ini mungkin bervariasi tergantung pada ponsel dan jaringan).
6. Mengakses Server dari Laptop Client
Di laptop client, buka aplikasi client Anda dan gunakan IP server yang ditemukan di langkah sebelumnya.
Contohnya, jika server berjalan di port 5000, maka Anda dapat mengakses endpoint seperti:

http://192.168.43.10:5000/api/registrations
Dengan cara ini, client akan bisa mengakses REST API di server melalui IP tersebut.
7. Catatan Firewall (Jika Diperlukan)
Jika laptop client mengalami masalah akses ke server, periksa pengaturan firewall di laptop server untuk memastikan port yang digunakan (misalnya 5000) tidak diblokir.
Untuk pengujian awal, Anda bisa mematikan firewall sementara, lalu cek apakah client bisa terhubung ke server.
