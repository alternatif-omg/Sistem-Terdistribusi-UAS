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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Data Absensi</a></li>
                            <li class="breadcrumb-item active">Data Absensi</li>
                        </ol>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="float-end d-none d-sm-block">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahAbsensi">Tambah Absensi</button>
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
                            <h4 class="header-title">Data Absensi</h4>
                            <p class="card-title-desc">
                                Kelola seluruh data absensi siswa pada kegiatan ekstrakurikuler
                            </p>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Siswa</th>
                                        <th>Kegiatan</th>
                                        <th>Tanggal Absen</th>
                                        <th>Status</th>
                                        <th>Waktu Kehadiran</th>
                                        <th>Keterangan</th>
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
                                        <td>Hadir</td>
                                        <td>09:00</td>
                                        <td>Datang tepat waktu</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditAbsensi"
                                                onclick="fillEditForm('1', 'Andi Saputra', 'Futsal', '2023-10-15', 'Hadir', '09:00', 'Datang tepat waktu')">Edit</button>
                                            <a href="#" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                    <!-- Baris Data 2 -->
                                    <tr>
                                        <td>2</td>
                                        <td>Siti Aisyah</td>
                                        <td>Musik</td>
                                        <td>2023-11-01</td>
                                        <td>Izin</td>
                                        <td>--</td>
                                        <td>Alasan pribadi</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditAbsensi"
                                                onclick="fillEditForm('2', 'Siti Aisyah', 'Musik', '2023-11-01', 'Izin', '', 'Alasan pribadi')">Edit</button>
                                            <a href="#" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                    <!-- Baris Data 3 -->
                                    <tr>
                                        <td>3</td>
                                        <td>Budi Prasetyo</td>
                                        <td>Basket</td>
                                        <td>2023-09-20</td>
                                        <td>Bolos</td>
                                        <td>--</td>
                                        <td>--</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditAbsensi"
                                                onclick="fillEditForm('3', 'Budi Prasetyo', 'Basket', '2023-09-20', 'Bolos', '', '')">Edit</button>
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

<!-- Modal Tambah Absensi -->
<div class="modal fade" id="modalTambahAbsensi" tabindex="-1" role="dialog" aria-labelledby="modalTambahAbsensiLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="modalTambahAbsensiLabel">Tambah Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation" action="" method="post" novalidate>
                <div class="modal-body">
                    <div class="row">
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
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal_absen" class="form-label">Tanggal Absen</label>
                                <input class="form-control" type="date" id="tanggal_absen" name="tanggal_absen" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status_absen" class="form-label">Status</label>
                                <select class="form-select" id="status_absen" name="status_absen" required>
                                    <option value="" selected disabled>Pilih Status</option>
                                    <option value="Hadir">Hadir</option>
                                    <option value="Izin">Izin</option>
                                    <option value="Bolos">Bolos</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Kolom Waktu Kehadiran -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="check_in_time" class="form-label">Waktu Kehadiran</label>
                                <input type="time" class="form-control" id="check_in_time" name="check_in_time" required>
                            </div>
                        </div>
                    </div>
                    <!-- Kolom Keterangan -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="notes" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect waves-light w-100">Tambahkan Absensi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Absensi -->
<div class="modal fade" id="modalEditAbsensi" tabindex="-1" role="dialog" aria-labelledby="modalEditAbsensiLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditAbsensiLabel">Edit Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation" action="" method="post" novalidate>
                <div class="modal-body">
                    <input type="hidden" id="edit_id_absen" name="id_absen">
                    <div class="row">
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
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_tanggal_absen" class="form-label">Tanggal Absen</label>
                                <input class="form-control" type="date" id="edit_tanggal_absen" name="tanggal_absen" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_status_absen" class="form-label">Status</label>
                                <select class="form-select" id="edit_status_absen" name="status_absen" required>
                                    <option value="" selected disabled>Pilih Status</option>
                                    <option value="Hadir">Hadir</option>
                                    <option value="Izin">Izin</option>
                                    <option value="Bolos">Bolos</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Kolom Waktu Kehadiran -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_check_in_time" class="form-label">Waktu Kehadiran</label>
                                <input type="time" class="form-control" id="edit_check_in_time" name="check_in_time" required>
                            </div>
                        </div>
                    </div>
                    <!-- Kolom Keterangan -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="edit_notes" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="edit_notes" name="notes" rows="3"></textarea>
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
    // Function to fill edit form with existing data
    function fillEditForm(id, nama_siswa, nama_aktivitas, tanggal_absen, status_absen, check_in_time, notes) {
        // Set hidden ID field and other fields
        document.getElementById('edit_id_absen').value = id;
        document.getElementById('edit_tanggal_absen').value = tanggal_absen;
        document.getElementById('edit_status_absen').value = status_absen;
        document.getElementById('edit_check_in_time').value = check_in_time; // Add check_in_time
        document.getElementById('edit_notes').value = notes; // Add notes

        // Fetch and set Nama Siswa
        const siswaData = {
            1: "Andi Saputra",
            2: "Siti Aisyah",
            3: "Budi Prasetyo"
        };
        const idSiswa = Object.keys(siswaData).find(key => siswaData[key] === nama_siswa);
        if (idSiswa) {
            document.getElementById('edit_id_siswa').value = idSiswa;
            document.getElementById('edit_nama_siswa').value = siswaData[idSiswa];
        }

        // Fetch and set Nama Aktivitas
        const aktivitasData = {
            101: "Futsal",
            102: "Musik",
            103: "Basket"
        };
        const idAktivitas = Object.keys(aktivitasData).find(key => aktivitasData[key] === nama_aktivitas);
        if (idAktivitas) {
            document.getElementById('edit_id_aktivitas').value = idAktivitas;
            document.getElementById('edit_nama_aktivitas').value = aktivitasData[idAktivitas];
        }
    }

    // Fetch Nama Siswa (on change)
    function fetchNamaSiswa(id) {
        const siswaData = {
            1: "Andi Saputra",
            2: "Siti Aisyah",
            3: "Budi Prasetyo"
        };
        document.getElementById('nama_siswa').value = siswaData[id] || "";
    }

    // Fetch Nama Aktivitas (on change)
    function fetchNamaAktivitas(id) {
        const aktivitasData = {
            101: "Futsal",
            102: "Musik",
            103: "Basket"
        };
        document.getElementById('nama_aktivitas').value = aktivitasData[id] || "";
    }

    // Fetch Nama Siswa for Edit Modal
    function fetchNamaSiswaEdit(id) {
        const siswaData = {
            1: "Andi Saputra",
            2: "Siti Aisyah",
            3: "Budi Prasetyo"
        };
        document.getElementById('edit_nama_siswa').value = siswaData[id] || "";
    }

    // Fetch Nama Aktivitas for Edit Modal
    function fetchNamaAktivitasEdit(id) {
        const aktivitasData = {
            101: "Futsal",
            102: "Musik",
            103: "Basket"
        };
        document.getElementById('edit_nama_aktivitas').value = aktivitasData[id] || "";
    }
</script>