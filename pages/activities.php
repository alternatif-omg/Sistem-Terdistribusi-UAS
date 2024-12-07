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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Data Kegiatan</a></li>
                            <li class="breadcrumb-item active">Data Kegiatan</li>
                        </ol>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="float-end d-none d-sm-block">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahKegiatan">Tambah Kegiatan</button>
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
                            <h4 class="header-title">Data Kegiatan</h4>
                            <p class="card-title-desc">
                                Kelola seluruh data kegiatan ekstrakurikuler
                            </p>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID Kegiatan</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Deskripsi</th>
                                        <th>Jadwal</th>
                                        <th>Instruktur</th>
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

<!-- Modal Tambah Kegiatan -->
<div class="modal fade" id="modalTambahKegiatan" tabindex="-1" role="dialog" aria-labelledby="modalTambahKegiatanLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="modalTambahKegiatanLabel">Tambah Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation" action="" method="post" novalidate>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                                <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" placeholder="Masukkan Nama Kegiatan" required>
                                <div class="invalid-feedback">
                                    Inputan anda belum valid.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jadwal_hari" class="form-label">Hari</label>
                                <select class="form-select" id="jadwal_hari" onchange="generateJadwal()" required>
                                    <option value="" selected disabled>Pilih Hari</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jadwal_mulai" class="form-label">Jam Mulai</label>
                                <input type="time" class="form-control" id="jadwal_mulai" onchange="generateJadwal()" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jadwal_berakhir" class="form-label">Jam Berakhir</label>
                                <input type="time" class="form-control" id="jadwal_berakhir" onchange="generateJadwal()" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="jadwal_kegiatan" class="form-label">Jadwal</label>
                                <input type="text" class="form-control" id="jadwal_kegiatan" name="jadwal_kegiatan" placeholder="Jadwal" disabled required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="deskripsi_kegiatan" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi_kegiatan" name="deskripsi_kegiatan" placeholder="Masukkan Deskripsi Kegiatan" rows="3" required></textarea>
                                <div class="invalid-feedback">
                                    Inputan anda belum valid.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="instruktur_kegiatan" class="form-label">Instruktur</label>
                                <input type="text" class="form-control" id="instruktur_kegiatan" name="instruktur_kegiatan" placeholder="Masukkan Nama Instruktur" required>
                                <div class="invalid-feedback">
                                    Inputan anda belum valid.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary waves-effect waves-light w-100" onclick="addActivity()">Tambahkan Kegiatan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Edit Kegiatan -->
<div class="modal fade" id="modalEditKegiatan" tabindex="-1" role="dialog" aria-labelledby="modalEditKegiatanLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditKegiatanLabel">Edit Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation" action="" method="post" novalidate>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="edit_id_kegiatan" name="id_kegiatan">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_nama_kegiatan" class="form-label">Nama Kegiatan</label>
                                <input type="text" class="form-control" id="edit_nama_kegiatan" name="nama_kegiatan" placeholder="Masukkan Nama Kegiatan" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_jadwal_hari" class="form-label">Hari</label>
                                <select class="form-select" id="edit_jadwal_hari" onchange="generateEditJadwal()" required>
                                    <option value="" selected disabled>Pilih Hari</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_jadwal_mulai" class="form-label">Jam Mulai</label>
                                <input type="time" class="form-control" id="edit_jadwal_mulai" onchange="generateEditJadwal()" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_jadwal_berakhir" class="form-label">Jam Berakhir</label>
                                <input type="time" class="form-control" id="edit_jadwal_berakhir" onchange="generateEditJadwal()" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="edit_jadwal_kegiatan" class="form-label">Jadwal</label>
                                <input type="text" class="form-control" id="edit_jadwal_kegiatan" name="jadwal_kegiatan" placeholder="Jadwal" disabled required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_deskripsi_kegiatan" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="edit_deskripsi_kegiatan" name="deskripsi_kegiatan" placeholder="Masukkan Deskripsi Kegiatan" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_instruktur_kegiatan" class="form-label">Instruktur</label>
                                <input type="text" class="form-control" id="edit_instruktur_kegiatan" name="instruktur_kegiatan" placeholder="Masukkan Nama Instruktur" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary waves-effect waves-light w-100" onclick="updateActivity()">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>