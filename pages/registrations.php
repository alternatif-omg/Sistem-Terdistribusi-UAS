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
                                        <th>Tanggal Daftar</th>
                                        <th>Jabatan</th>
                                        <th>Biaya Pendaftaran</th>
                                        <th>Status</th>
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
                        <!-- Kolom Pilih Siswa -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_siswa" class="form-label">Pilih Siswa</label>
                                <select class="form-select" id="id_siswa" name="id_siswa" required>
                                    <option value="" selected disabled>Pilih Siswa</option>
                                    <!-- Data siswa akan diisi oleh JavaScript -->
                                </select>
                            </div>
                        </div>
                        <!-- Kolom Pilih Aktivitas -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_aktivitas" class="form-label">Pilih Aktivitas</label>
                                <select class="form-select" id="id_aktivitas" name="id_aktivitas" required>
                                    <option value="" selected disabled>Pilih Aktivitas</option>
                                    <!-- Data aktivitas akan diisi oleh JavaScript -->
                                </select>
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
                    <button type="button" class="btn btn-primary waves-effect waves-light w-100" onclick="addRegistration()">Tambahkan Pendaftaran</button>
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
                        <!-- Kolom Pilih Siswa -->
                        <input type="hidden" id="edit_id_pendaftaran" name="id_pendaftaran">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_id_siswa" class="form-label">Pilih Siswa</label>
                                <select class="form-select" id="edit_id_siswa" name="id_siswa" required>
                                    <option value="" selected disabled>Pilih Siswa</option>
                                </select>
                            </div>
                        </div>
                        <!-- Kolom Pilih Aktivitas -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_id_aktivitas" class="form-label">Pilih Aktivitas</label>
                                <select class="form-select" id="edit_id_aktivitas" name="id_aktivitas" required>
                                    <option value="" selected disabled>Pilih Aktivitas</option>
                                </select>
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
                    <button type="button" class="btn btn-primary waves-effect waves-light w-100" onclick="editRegistration()">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>