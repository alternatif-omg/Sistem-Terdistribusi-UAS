// Panggil `loadStudents` saat halaman dimuat
document.addEventListener("DOMContentLoaded", () => {
    loadStudents();
});

function loadStudents() {
    fetch(`${CONFIG.BASE_URL}server.php?type=students`)
        .then(response => {
            console.log('Response:', response);
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log('Data:', data);
            const tbody = document.getElementById('students-tbody');
            tbody.innerHTML = ''; // Kosongkan konten tabel

            // Iterasi data dan tambahkan ke tabel
            data.forEach(student => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${student.student_id}</td>
                    <td>${student.name}</td>
                    <td>${student.class}</td>
                    <td>${student.contact}</td>
                    <td>${student.birth_date}</td>
                    <td>
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditData"
                            onclick="fillEditForm('${student.student_id}', '${student.name}', '${student.class}', '${student.contact}', '${student.birth_date}')">Edit</button>
                        <a href="#" class="btn btn-danger btn-sm" onclick="deleteStudent('${student.student_id}')">Hapus</a>
                    </td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

// Fungsi untuk menghapus data siswa
function deleteStudent(studentId) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        fetch(`${CONFIG.BASE_URL}server.php?type=students&id=${studentId}`, {
            method: "DELETE",
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.message === "Student deleted successfully") {
                    alert("Data berhasil dihapus.");
                    // Refresh data siswa setelah penghapusan
                    loadStudents();
                } else {
                    alert("Gagal menghapus data: " + data.message);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("Terjadi kesalahan saat menghapus data.");
            });
    }
}

// Fungsi untuk mengisi form edit
function fillEditForm(id, nama, kelas, kontak, tgl_lahir) {
    document.getElementById('edit_id_siswa').value = id;
    document.getElementById('edit_nama_siswa').value = nama;
    document.getElementById('edit_kelas').value = kelas;
    document.getElementById('edit_kontak').value = kontak;
    document.getElementById('edit_tgl_lahir').value = tgl_lahir;
}

// Fungsi untuk edit data siswa
function editStudent() {
    // Ambil data dari modal edit
    const studentId = document.getElementById('edit_id_siswa').value;
    const name = document.getElementById('edit_nama_siswa').value;
    const studentClass = document.getElementById('edit_kelas').value;
    const contact = document.getElementById('edit_kontak').value;
    const birthDate = document.getElementById('edit_tgl_lahir').value;

    // Validasi input
    if (!name || !studentClass || !contact || !birthDate) {
        alert("Semua kolom harus diisi.");
        return;
    }

    // Data yang akan dikirim
    const data = {
        student_id: studentId,
        name: name,
        class: studentClass,
        contact: contact,
        birth_date: birthDate
    };

    // Kirim request PUT ke server
    fetch(`${CONFIG.BASE_URL}server.php?type=students&id=${studentId}`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(result => {
            if (result.message === "Student updated successfully") {
                alert("Data berhasil diperbarui.");
                // Tutup modal dan refresh data
                $('#modalEditData').modal('hide');
                loadStudents(); // Panggil fungsi untuk memuat ulang data siswa
            } else {
                alert("Gagal memperbarui data: " + result.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat memperbarui data.");
        });
}

// Fungsi untuk menambahkan data siswa
function addStudent() {
    // Ambil data dari modal tambah
    const name = document.getElementById('nama_siswa').value;
    const studentClass = document.getElementById('kelas').value;
    const contact = document.getElementById('kontak').value;
    const birthDate = document.getElementById('tgl_lahir').value;

    // Validasi input
    if (!name || !studentClass || !contact || !birthDate) {
        alert("Semua kolom harus diisi.");
        return;
    }

    // Data yang akan dikirim
    const data = {
        student_id: Date.now().toString(), // Menggunakan timestamp sebagai ID sementara
        name: name,
        class: studentClass,
        contact: contact,
        birth_date: birthDate
    };

    // Kirim request POST ke server
    fetch(`${CONFIG.BASE_URL}server.php?type=students`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(result => {
            if (result.message === "Student created successfully") {
                alert("Data berhasil ditambahkan.");
                // Tutup modal dan refresh data
                $('#modalTambahData').modal('hide');
                loadStudents(); // Panggil fungsi untuk memuat ulang data siswa
            } else {
                alert("Gagal menambahkan data: " + result.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat menambahkan data.");
        });
}
