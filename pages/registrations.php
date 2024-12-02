<div class="page-content">
    <!-- start page title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h4>Absensi Ekstrakurikuler</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Data</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Data Pendaftaran</a></li>
                            <li class="breadcrumb-item active">Data Pendaftaran</li>
                        </ol>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="float-end d-none d-sm-block">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahPendaftaran">Tambah Pendaftaran</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="container-fluid">
        <div class="page-content-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Data Pendaftaran</h4>
                            <p class="card-title-desc">
                                Kelola seluruh data pendaftaran siswa pada kegiatan ekstrakurikuler
                            </p>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Siswa</th>
                                        <th>Kegiatan</th>
                                        <th>Tanggal Pendaftaran</th>
                                        <th>Jabatan</th>
                                        <th>Biaya Pendaftaran</th>
                                        <th>Status Konfirmasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Baris Data 1 -->
                                    <tr>
                                        <td>1</td>
                                        <td>Andi Saputra</td>
                                        <td>Futsal</td>
                                        <td>2023-10-15</td>
                                        <td>Ketua</td>
                                        <td>Rp 100,000</td> 
                                        <td>Berhasil</td> 
                                        <td>
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditPendaftaran"
                                                onclick="fillEditForm('1', 'Andi Saputra', 'Futsal', '2023-10-15', 'Ketua', '100000', 'berhasil')">Edit</button>
                                            <a href="#" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                    <!-- Baris Data 2 -->
                                    <tr>
                                        <td>2</td>
                                        <td>Siti Aisyah</td>
                                        <td>Musik</td>
                                        <td>2023-11-01</td>
                                        <td>Anggota</td>
                                        <td>Rp 75,000</td> 
                                        <td>Tertunda</td> 
                                        <td>
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditPendaftaran"
                                                onclick="fillEditForm('2', 'Siti Aisyah', 'Musik', '2023-11-01', 'Anggota', '75000', 'tertunda')">Edit</button>
                                            <a href="#" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                    <!-- Baris Data 3 -->
                                    <tr>
                                        <td>3</td>
                                        <td>Budi Prasetyo</td>
                                        <td>Basket</td>
                                        <td>2023-09-20</td>
                                        <td>Wakil Ketua</td>
                                        <td>Rp 120,000</td> 
                                        <td>Berhasil</td> 
                                        <td>
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditPendaftaran"
                                                onclick="fillEditForm('3', 'Budi Prasetyo', 'Basket', '2023-09-20', 'Wakil Ketua', '120000', 'berhasil')">Edit</button>
                                            <a href="#" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

<!-- Modal Tambah Pendaftaran -->
<div class="modal fade" id="modalTambahPendaftaran" tabindex="-1" role="dialog" aria-labelledby="modalTambahPendaftaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="modalTambahPendaftaranLabel">Tambah Pendaftaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation" action="" method="post" novalidate>
                <div class="modal-body">
                    <div class="row">
                        <!-- Kolom ID Siswa dan Nama Siswa -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_siswa" class="form-label">ID Siswa</label>
                                <select class="form-select" id="id_siswa" name="id_siswa" onchange="fetchNamaSiswa(this.value)" required>
                                    <option value="" selected disabled>Pilih ID Siswa</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama_siswa" class="form-label">Nama Siswa</label>
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Nama Siswa" disabled>
                            </div>
                        </div>
                        <!-- Kolom ID Aktivitas dan Nama Aktivitas -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_aktivitas" class="form-label">ID Aktivitas</label>
                                <select class="form-select" id="id_aktivitas" name="id_aktivitas" onchange="fetchNamaAktivitas(this.value)" required>
                                    <option value="" selected disabled>Pilih ID Aktivitas</option>
                                    <option value="101">101</option>
                                    <option value="102">102</option>
                                    <option value="103">103</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama_aktivitas" class="form-label">Nama Aktivitas</label>
                                <input type="text" class="form-control" id="nama_aktivitas" name="nama_aktivitas" placeholder="Nama Aktivitas" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Kolom Tanggal Pendaftaran -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal_pendaftaran" class="form-label">Tanggal Pendaftaran</label>
                                <input class="form-control" type="date" id="tanggal_pendaftaran" name="tanggal_pendaftaran" required>
                            </div>
                        </div>
                        <!-- Kolom Jabatan -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <select class="form-select" id="jabatan" name="jabatan" required>
                                    <option value="" selected disabled>Pilih Jabatan</option>
                                    <option value="Anggota">Anggota</option>
                                    <option value="Wakil Ketua">Wakil Ketua</option>
                                    <option value="Ketua">Ketua</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Kolom Biaya Pendaftaran -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="registration_fee" class="form-label">Biaya Pendaftaran</label>
                                <input type="number" class="form-control" id="registration_fee" name="registration_fee" placeholder="Biaya Pendaftaran" required>
                            </div>
                        </div>
                        <!-- Kolom Status Konfirmasi -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="confirmation_status" class="form-label">Status Konfirmasi</label>
                                <select class="form-select" id="confirmation_status" name="confirmation_status" required>
                                    <option value="" selected disabled>Pilih Status Konfirmasi</option>
                                    <option value="berhasil">Berhasil</option>
                                    <option value="tertunda">Tertunda</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect waves-light w-100">Tambahkan Pendaftaran</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Edit Pendaftaran -->
<div class="modal fade" id="modalEditPendaftaran" tabindex="-1" role="dialog" aria-labelledby="modalEditPendaftaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditPendaftaranLabel">Edit Pendaftaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation" action="" method="post" novalidate>
                <div class="modal-body">
                    <div class="row">
                        <!-- Kolom ID Siswa dan Nama Siswa -->
                        <input type="hidden" id="edit_id_pendaftaran" name="id_pendaftaran">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_id_siswa" class="form-label">ID Siswa</label>
                                <select class="form-select" id="edit_id_siswa" name="id_siswa" onchange="fetchNamaSiswaEdit(this.value)" required>
                                    <option value="" selected disabled>Pilih ID Siswa</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit_nama_siswa" class="form-label">Nama Siswa</label>
                                <input type="text" class="form-control" id="edit_nama_siswa" name="nama_siswa" placeholder="Nama Siswa" disabled>
                            </div>
                        </div>
                        <!-- Kolom ID Aktivitas dan Nama Aktivitas -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_id_aktivitas" class="form-label">ID Aktivitas</label>
                                <select class="form-select" id="edit_id_aktivitas" name="id_aktivitas" onchange="fetchNamaAktivitasEdit(this.value)" required>
                                    <option value="" selected disabled>Pilih ID Aktivitas</option>
                                    <option value="101">101</option>
                                    <option value="102">102</option>
                                    <option value="103">103</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit_nama_aktivitas" class="form-label">Nama Aktivitas</label>
                                <input type="text" class="form-control" id="edit_nama_aktivitas" name="nama_aktivitas" placeholder="Nama Aktivitas" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Kolom Tanggal Pendaftaran -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_tanggal_pendaftaran" class="form-label">Tanggal Pendaftaran</label>
                                <input class="form-control" type="date" id="edit_tanggal_pendaftaran" name="tanggal_pendaftaran" required>
                            </div>
                        </div>
                        <!-- Kolom Jabatan -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_jabatan" class="form-label">Jabatan</label>
                                <select class="form-select" id="edit_jabatan" name="jabatan" required>
                                    <option value="" selected disabled>Pilih Jabatan</option>
                                    <option value="Anggota">Anggota</option>
                                    <option value="Wakil Ketua">Wakil Ketua</option>
                                    <option value="Ketua">Ketua</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Kolom Biaya Pendaftaran -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_registration_fee" class="form-label">Biaya Pendaftaran</label>
                                <input type="number" class="form-control" id="edit_registration_fee" name="registration_fee" placeholder="Biaya Pendaftaran" required>
                            </div>
                        </div>
                        <!-- Kolom Status Konfirmasi -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_confirmation_status" class="form-label">Status Konfirmasi</label>
                                <select class="form-select" id="edit_confirmation_status" name="confirmation_status" required>
                                    <option value="" selected disabled>Pilih Status Konfirmasi</option>
                                    <option value="berhasil">Berhasil</option>
                                    <option value="tertunda">Tertunda</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect waves-light w-100">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function fillEditForm(id, nama_siswa, nama_aktivitas, tanggal_pendaftaran, jabatan, registration_fee, confirmation_status) {
        document.getElementById('edit_id_pendaftaran').value = id;
        document.getElementById('edit_tanggal_pendaftaran').value = tanggal_pendaftaran;
        document.getElementById('edit_jabatan').value = jabatan;
        document.getElementById('edit_registration_fee').value = registration_fee;
        document.getElementById('edit_confirmation_status').value = confirmation_status;

        const siswaData = {
            1: "Andi Saputra",
            2: "Siti Aisyah",
            3: "Budi Prasetyo"
        };
        const aktivitasData = {
            101: "Futsal",
            102: "Musik",
            103: "Basket"
        };

        // Mencari ID siswa dan aktivitas berdasarkan nama
        const idSiswa = Object.keys(siswaData).find(key => siswaData[key] === nama_siswa);
        const idAktivitas = Object.keys(aktivitasData).find(key => aktivitasData[key] === nama_aktivitas);

        if (idSiswa) {
            document.getElementById('edit_id_siswa').value = idSiswa;
            document.getElementById('edit_nama_siswa').value = siswaData[idSiswa];
        }

        if (idAktivitas) {
            document.getElementById('edit_id_aktivitas').value = idAktivitas;
            document.getElementById('edit_nama_aktivitas').value = aktivitasData[idAktivitas];
        }
    }

    function fetchNamaSiswa(id) {
        const siswaData = {
            1: "Andi Saputra",
            2: "Siti Aisyah",
            3: "Budi Prasetyo"
        };
        document.getElementById('nama_siswa').value = siswaData[id] || "";
    }

    function fetchNamaAktivitas(id) {
        const aktivitasData = {
            101: "Futsal",
            102: "Musik",
            103: "Basket"
        };
        document.getElementById('nama_aktivitas').value = aktivitasData[id] || "";
    }

    function fetchNamaSiswaEdit(id) {
        const siswaData = {
            1: "Andi Saputra",
            2: "Siti Aisyah",
            3: "Budi Prasetyo"
        };
        document.getElementById('edit_nama_siswa').value = siswaData[id] || "";
    }

    function fetchNamaAktivitasEdit(id) {
        const aktivitasData = {
            101: "Futsal",
            102: "Musik",
            103: "Basket"
        };
        document.getElementById('edit_nama_aktivitas').value = aktivitasData[id] || "";
    }
</script>