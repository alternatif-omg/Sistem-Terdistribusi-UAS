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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Data Siswa</a></li>
                            <li class="breadcrumb-item active">Data Siswa</li>
                        </ol>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="float-end d-none d-sm-block">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahData">Tambah Data</button>
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
                            <h4 class="header-title">Data Siswa</h4>
                            <p class="card-title-desc">
                                Kelola seluruh data siswa yang terdaftar di sekolah
                            </p>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID Siswa</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Kontak</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="students-tbody">
                                    
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


<!-- Modal content -->
<div class="modal fade bs-example-modal-xl" id="modalTambahData" tabindex="-1" role="dialog" aria-labelledby="modalTambahData" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="modalTambahDataLabel">Tambah Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation" action="" method="post" novalidate>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_siswa" class="form-label">Nama Siswa</label>
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Masukkan Nama Siswa" value="" required>
                                <div class="invalid-feedback">
                                    Inputan anda belum valid.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Masukkan Kelas" value="" required autofocus>
                                <div class="invalid-feedback">
                                    Inputan anda belum valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kontak" class="form-label">Kontak</label>
                                <input type="number" class="form-control" id="kontak" name="kontak" placeholder="Masukkan Kontak" value="" required>
                                <div class="invalid-feedback">
                                    Inputan anda belum valid.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                <input class="form-control" type="date" value="" id="tgl_lahir" name="tgl_lahir" required>
                                <div class="invalid-feedback">
                                    Inputan anda belum valid.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary waves-effect waves-light w-100" onclick="addStudent()">Tambahkan Data</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEditData" tabindex="-1" role="dialog" aria-labelledby="modalEditDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditDataLabel">Edit Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation" action="" method="post" novalidate>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="edit_id_siswa" name="id_siswa" value="">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_nama_siswa" class="form-label">Nama Siswa</label>
                                <input type="text" class="form-control" id="edit_nama_siswa" name="nama_siswa" placeholder="Masukkan Nama Siswa" value="" required>
                                <div class="invalid-feedback">
                                    Inputan anda belum valid.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_kelas" class="form-label">Kelas</label>
                                <input type="text" class="form-control" id="edit_kelas" name="kelas" placeholder="Masukkan Kelas" value="" required>
                                <div class="invalid-feedback">
                                    Inputan anda belum valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_kontak" class="form-label">Kontak</label>
                                <input type="number" class="form-control" id="edit_kontak" name="kontak" placeholder="Masukkan Kontak" value="" required>
                                <div class="invalid-feedback">
                                    Inputan anda belum valid.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_tgl_lahir" class="form-label">Tanggal Lahir</label>
                                <input class="form-control" type="date" value="" id="edit_tgl_lahir" name="tgl_lahir" required>
                                <div class="invalid-feedback">
                                    Inputan anda belum valid.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary waves-effect waves-light w-100" onclick="editStudent()">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
