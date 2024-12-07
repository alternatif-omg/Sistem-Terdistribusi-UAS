// Panggil loadRegistrations saat halaman dimuat
document.addEventListener("DOMContentLoaded", () => {
    loadRegistrations();
    loadStudentsDropdown(); // Memuat dropdown siswa
    loadActivitiesDropdown(); // Memuat dropdown aktivitas
});

// Fungsi untuk memuat data pendaftaran
function loadRegistrations() {
    const endpoint = `${CONFIG.BASE_URL}server.php?type=registrations`;

    fetch(endpoint)
        .then((response) => {
            if (!response.ok) {
                throw new Error("Gagal mengambil data: " + response.statusText);
            }
            return response.json();
        })
        .then((data) => {
            // Hancurkan DataTables jika sudah diinisialisasi
            if ($.fn.DataTable.isDataTable('#datatable')) {
                $('#datatable').DataTable().destroy();
            }

            const tbody = document.getElementById("datatable").querySelector("tbody");
            tbody.innerHTML = ""; // Kosongkan isi tabel sebelum memuat data baru

            data.forEach((registration) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${registration.registration_id}</td>
                    <td>${registration.student_name}</td>
                    <td>${registration.activity_name}</td>
                    <td>${registration.registration_date}</td>
                    <td>${registration.position}</td>
                    <td>Rp ${Number(registration.registration_fee).toLocaleString()}</td>
                    <td>${registration.confirmation_status}</td>
                    <td>
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditPendaftaran"
                            onclick="fillEditForm('${registration.registration_id}', '${registration.student_name}', '${registration.activity_name}', '${registration.registration_date}', '${registration.position}', '${registration.registration_fee}', '${registration.confirmation_status}')">Edit</button>
                        <a href="#" class="btn btn-danger btn-sm" onclick="deleteRegistration('${registration.registration_id}')">Hapus</a>
                    </td>
                `;
                tbody.appendChild(row);
            });

            // Inisialisasi ulang DataTables
            $('#datatable').DataTable({
                responsive: true,
                autoWidth: false,
            });
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Gagal memuat data. Silakan coba lagi.");
        });
}

function fillEditForm(id, namaSiswa, namaAktivitas, tanggalPendaftaran, jabatan, registrationFee, confirmationStatus) {
    // Set nilai input lain
    document.getElementById('edit_id_pendaftaran').value = id;
    document.getElementById('edit_tanggal_pendaftaran').value = tanggalPendaftaran;
    document.getElementById('edit_jabatan').value = jabatan;
    document.getElementById('edit_registration_fee').value = registrationFee;
    document.getElementById('edit_confirmation_status').value = confirmationStatus;

    // Fetch data siswa untuk dropdown
    fetch(`${CONFIG.BASE_URL}server.php?type=students`)
        .then((response) => {
            if (!response.ok) throw new Error("Gagal mengambil data siswa");
            return response.json();
        })
        .then((students) => {
            const selectSiswa = document.getElementById('edit_id_siswa');
            selectSiswa.innerHTML = '<option value="" disabled>Pilih Siswa</option>';
            students.forEach((student) => {
                const option = document.createElement('option');
                option.value = student.student_id;
                option.textContent = `${student.student_id} - ${student.name}`;
                if (student.name === namaSiswa) option.selected = true;
                selectSiswa.appendChild(option);
            });
        })
        .catch((error) => {
            console.error("Error fetching students:", error);
            alert("Gagal memuat data siswa.");
        });

    // Fetch data aktivitas untuk dropdown
    fetch(`${CONFIG.BASE_URL}server.php?type=Activities`)
        .then((response) => {
            if (!response.ok) throw new Error("Gagal mengambil data aktivitas");
            return response.json();
        })
        .then((activities) => {
            const selectAktivitas = document.getElementById('edit_id_aktivitas');
            selectAktivitas.innerHTML = '<option value="" disabled>Pilih Aktivitas</option>';
            activities.forEach((activity) => {
                const option = document.createElement('option');
                option.value = activity.activity_id;
                option.textContent = `${activity.activity_id} - ${activity.name}`;
                if (activity.name === namaAktivitas) option.selected = true;
                selectAktivitas.appendChild(option);
            });
        })
        .catch((error) => {
            console.error("Error fetching activities:", error);
            alert("Gagal memuat data aktivitas.");
        });
}

function editRegistration() {
    // Ambil nilai dari modal edit
    const registrationId = document.getElementById('edit_id_pendaftaran').value;
    const studentId = document.getElementById('edit_id_siswa').value;
    const activityId = document.getElementById('edit_id_aktivitas').value;
    const registrationDate = document.getElementById('edit_tanggal_pendaftaran').value;
    const position = document.getElementById('edit_jabatan').value;
    const registrationFee = document.getElementById('edit_registration_fee').value;
    const confirmationStatus = document.getElementById('edit_confirmation_status').value;

    // Validasi form
    if (!studentId || !activityId || !registrationDate || !position || !registrationFee || !confirmationStatus) {
        alert("Mohon lengkapi semua data!");
        return;
    }

    // Data yang akan dikirim ke server
    const registrationData = {
        registration_id: registrationId,
        student_id: studentId,
        activity_id: activityId,
        registration_date: registrationDate,
        position: position,
        registration_fee: registrationFee,
        confirmation_status: confirmationStatus,
    };

    // Kirim data ke server
    fetch(`${CONFIG.BASE_URL}server.php?type=registrations&id=${registrationId}`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(registrationData),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Gagal mengupdate data: ${response.statusText}`);
            }
            return response.json();
        })
        .then((data) => {
            if (data.message === "Registration updated successfully") {
                alert("Data berhasil diperbarui.");
                // Tutup modal setelah berhasil diperbarui
                const modalEdit = document.getElementById('modalEditPendaftaran');
                const modalInstance = bootstrap.Modal.getInstance(modalEdit);
                modalInstance.hide();

                // Muat ulang data tabel
                loadRegistrations();
            } else {
                alert(`Gagal mengupdate data: ${data.message}`);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat mengupdate data.");
        });
}

// Fungsi untuk memuat data siswa ke dropdown
function loadStudentsDropdown() {
    const endpoint = `${CONFIG.BASE_URL}server.php?type=students`;
    fetch(endpoint)
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Gagal mengambil data siswa: ${response.statusText}`);
            }
            return response.json();
        })
        .then((students) => {
            const dropdown = document.getElementById("id_siswa");
            dropdown.innerHTML = `<option value="" selected disabled>Pilih Siswa</option>`; // Reset opsi
            students.forEach((student) => {
                const option = document.createElement("option");
                option.value = student.student_id;
                option.textContent = `${student.student_id} - ${student.name}`;
                dropdown.appendChild(option);
            });
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Gagal memuat data siswa.");
        });
}

// Fungsi untuk memuat data aktivitas ke dropdown
function loadActivitiesDropdown() {
    const endpoint = `${CONFIG.BASE_URL}server.php?type=Activities`;
    fetch(endpoint)
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Gagal mengambil data aktivitas: ${response.statusText}`);
            }
            return response.json();
        })
        .then((activities) => {
            const dropdown = document.getElementById("id_aktivitas");
            dropdown.innerHTML = `<option value="" selected disabled>Pilih Aktivitas</option>`; // Reset opsi
            activities.forEach((activity) => {
                const option = document.createElement("option");
                option.value = activity.activity_id;
                option.textContent = `${activity.activity_id} - ${activity.name}`;
                dropdown.appendChild(option);
            });
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Gagal memuat data aktivitas.");
        });
}

// Fungsi untuk menambahkan data pendaftaran
function addRegistration() {
    // Ambil data dari form
    const studentId = document.getElementById("id_siswa").value;
    const activityId = document.getElementById("id_aktivitas").value;
    const registrationDate = document.getElementById("tanggal_pendaftaran").value;
    const position = document.getElementById("jabatan").value;
    const registrationFee = document.getElementById("registration_fee").value;
    const confirmationStatus = document.getElementById("confirmation_status").value;

    // Validasi input
    if (!studentId || !activityId || !registrationDate || !position || !registrationFee || !confirmationStatus) {
        alert("Mohon lengkapi semua data!");
        return;
    }

    // Data yang akan dikirim
    const registrationData = {
        registration_id: Math.floor(300000 + Math.random() * 399999).toString(), // Menghasilkan ID pendaftaran unik
        student_id: studentId,
        activity_id: activityId,
        registration_date: registrationDate,
        position: position,
        registration_fee: registrationFee,
        confirmation_status: confirmationStatus,
    };

    // Kirim data ke server
    fetch(`${CONFIG.BASE_URL}server.php?type=registrations`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(registrationData),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Gagal menambahkan data: ${response.statusText}`);
            }
            return response.json();
        })
        .then((data) => {
            if (data.message === "Registration created successfully") {
                alert("Data berhasil ditambahkan.");
                // Reset form
                document.getElementById("id_siswa").value = "";
                document.getElementById("id_aktivitas").value = "";
                document.getElementById("tanggal_pendaftaran").value = "";
                document.getElementById("jabatan").value = "";
                document.getElementById("registration_fee").value = "";
                document.getElementById("confirmation_status").value = "";

                // Tutup modal
                const modal = document.getElementById("modalTambahPendaftaran");
                const modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();

                // Muat ulang tabel data
                loadRegistrations();
            } else {
                alert(`Gagal menambahkan data: ${data.message}`);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat menambahkan data.");
        });
}

// Fungsi untuk menghapus data pendaftaran
function deleteRegistration(registrationId) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        // Kirim permintaan DELETE ke server
        fetch(`${CONFIG.BASE_URL}server.php?type=registrations&id=${registrationId}`, {
            method: "DELETE",
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`Gagal menghapus data: ${response.statusText}`);
                }
                return response.json();
            })
            .then((data) => {
                if (data.message === "Registration deleted successfully") {
                    alert("Data berhasil dihapus.");
                    // Muat ulang tabel data
                    loadRegistrations();
                } else {
                    alert(`Gagal menghapus data: ${data.message}`);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("Terjadi kesalahan saat menghapus data.");
            });
    }
}
