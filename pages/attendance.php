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
                                <label for="id_siswa" class="form-label">Pilih Siswa</label>
                                <select class="form-select" id="id_siswa" name="id_siswa" required>
                                    <option value="" selected disabled>Pilih Siswa</option>
                                    <!-- Dropdown akan diisi dengan ID - Nama Siswa -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_aktivitas" class="form-label">Pilih Aktivitas</label>
                                <select class="form-select" id="id_aktivitas" name="id_aktivitas" required>
                                    <option value="" selected disabled>Pilih Aktivitas</option>
                                    <!-- Dropdown akan diisi dengan ID - Nama Aktivitas -->
                                </select>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="check_in_time" class="form-label">Waktu Kehadiran</label>
                                <input type="time" class="form-control" id="check_in_time" name="check_in_time" required>
                            </div>
                        </div>
                    </div>
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
                    <button type="submit" class="btn btn-primary waves-effect waves-light w-100" onclick="addAttendance()">Tambahkan Absensi</button>
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
                                <label for="edit_id_siswa" class="form-label">Pilih Siswa</label>
                                <select class="form-select" id="edit_id_siswa" name="id_siswa" required>
                                    <option value="" selected disabled>Pilih Siswa</option>
                                    <!-- Dropdown akan diisi dengan ID - Nama Siswa -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_id_aktivitas" class="form-label">Pilih Aktivitas</label>
                                <select class="form-select" id="edit_id_aktivitas" name="id_aktivitas" required>
                                    <option value="" selected disabled>Pilih Aktivitas</option>
                                    <!-- Dropdown akan diisi dengan ID - Nama Aktivitas -->
                                </select>
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
                                    <option value="hadir">Hadir</option>
                                    <option value="izin">Izin</option>
                                    <option value="bolos">Bolos</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_check_in_time" class="form-label">Waktu Kehadiran</label>
                                <input type="time" class="form-control" id="edit_check_in_time" name="check_in_time" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="edit_notes" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="edit_notes" name="notes" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary waves-effect waves-light w-100" onclick="updateAttendance()">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>