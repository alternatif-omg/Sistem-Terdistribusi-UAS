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
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Andi Saputra</td>
                                        <td>10-A</td>
                                        <td>081234567890</td>
                                        <td>2005-03-15</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditData"
                                                onclick="fillEditForm('1', 'Andi Saputra', '10-A', '081234567890', '2005-03-15')">Edit</button>
                                            <a href="" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Siti Aisyah</td>
                                        <td>11-B</td>
                                        <td>081345678901</td>
                                        <td>2004-07-22</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditData"
                                                onclick="fillEditForm('2', 'Siti Aisyah', '11-B', '081345678901', '2004-07-22')">Edit</button>
                                            <a href="" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                    <!-- <tr>
                                        <td>3</td>
                                        <td>Budi Prasetyo</td>
                                        <td>10-C</td>
                                        <td>081456789012</td>
                                        <td>2005-09-10</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Ani Rahmawati</td>
                                        <td>12-A</td>
                                        <td>081567890123</td>
                                        <td>2003-12-05</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Joko Widodo</td>
                                        <td>11-C</td>
                                        <td>081678901234</td>
                                        <td>2004-01-15</td>
                                    </tr> -->
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
                    <button type="submit" class="btn btn-primary waves-effect waves-light w-100">Tambahkan Data</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
                    <button type="submit" class="btn btn-primary waves-effect waves-light w-100">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function fillEditForm(id, nama, kelas, kontak, tgl_lahir) {
        document.getElementById('edit_id_siswa').value = id;
        document.getElementById('edit_nama_siswa').value = nama;
        document.getElementById('edit_kelas').value = kelas;
        document.getElementById('edit_kontak').value = kontak;
        document.getElementById('edit_tgl_lahir').value = tgl_lahir;
    }
</script>