// Panggil loadAttendance saat halaman dimuat
document.addEventListener("DOMContentLoaded", () => {
    loadAttendance();
    loadStudentsDropdown(); // Memuat dropdown siswa
    loadActivitiesDropdown(); // Memuat dropdown aktivitas
});

// Fungsi untuk memuat data attendance
function loadAttendance() {
    const endpoint = `${CONFIG.BASE_URL}server.php?type=attendance`;

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

            data.forEach((attendance) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${attendance.attendance_id}</td>
                    <td>${attendance.student_name}</td>
                    <td>${attendance.activity_name}</td>
                    <td>${attendance.attendance_date}</td>
                    <td>${attendance.status}</td>
                    <td>${attendance.check_in_time || '--'}</td>
                    <td>${attendance.notes || '--'}</td>
                    <td>
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditAbsensi"
                            onclick="fillEditForm('${attendance.attendance_id}', '${attendance.student_id}', '${attendance.activity_id}', '${attendance.attendance_date}', '${attendance.status}', '${attendance.check_in_time}', '${attendance.notes}')">Edit</button>
                        <a href="#" class="btn btn-danger btn-sm" onclick="deleteAttendance('${attendance.attendance_id}')">Hapus</a>
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

// Fungsi untuk menambah data attendance
function addAttendance() {
    // Ambil data dari form
    const studentId = document.getElementById("id_siswa").value;
    const activityId = document.getElementById("id_aktivitas").value;
    const attendanceDate = document.getElementById("tanggal_absen").value;
    const status = document.getElementById("status_absen").value;
    const checkInTime = document.getElementById("check_in_time").value;
    const notes = document.getElementById("notes").value;

    // Validasi form
    if (!studentId || !activityId || !attendanceDate || !status || !checkInTime || !notes) {
        alert("Mohon lengkapi semua data wajib!");
        return;
    }

    // Data yang akan dikirim
    const attendanceData = {
        attendance_id: Math.floor(400000 + Math.random() * 499999).toString(), // Generate ID unik
        student_id: studentId,
        activity_id: activityId,
        attendance_date: attendanceDate,
        status: status,
        check_in_time: checkInTime,
        notes: notes,
    };

    // Kirim data ke server
    fetch(`${CONFIG.BASE_URL}server.php?type=attendance`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(attendanceData),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Gagal menambahkan data: ${response.statusText}`);
            }
            return response.json();
        })
        .then((data) => {
            if (data.message === "Attendance created successfully") {
                alert("Data absensi berhasil ditambahkan!");
                // Reset form setelah data berhasil ditambahkan
                document.getElementById("id_siswa").value = "";
                document.getElementById("id_aktivitas").value = "";
                document.getElementById("tanggal_absen").value = "";
                document.getElementById("status_absen").value = "";
                document.getElementById("check_in_time").value = "";
                document.getElementById("notes").value = "";
                // Tutup modal
                const modal = document.getElementById("modalTambahAbsensi");
                const modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();
                // Tambahkan jeda waktu sebelum load ulang data
                setTimeout(() => {
                    loadAttendance();
                }, 1000);
            } else {
                alert(`Gagal menambahkan data: ${data.message}`);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat menambahkan data.");
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

// Fungsi untuk menyimpan perubahan data attendance (edit data)
function updateAttendance() {
    // Ambil data dari form edit
    const attendanceId = document.getElementById("edit_id_absen").value;
    const studentId = document.getElementById("edit_id_siswa").value;
    const activityId = document.getElementById("edit_id_aktivitas").value;
    const attendanceDate = document.getElementById("edit_tanggal_absen").value;
    const status = document.getElementById("edit_status_absen").value;
    const checkInTime = document.getElementById("edit_check_in_time").value;
    const notes = document.getElementById("edit_notes").value;

    // Validasi form
    if (!studentId || !activityId || !attendanceDate || !status || !checkInTime || !notes) {
        alert("Mohon lengkapi semua data wajib!");
        return;
    }

    // Data yang akan dikirim
    const attendanceData = {
        student_id: studentId,
        activity_id: activityId,
        attendance_date: attendanceDate,
        status: status,
        check_in_time: checkInTime,
        notes: notes,
    };

    // Kirim data ke server
    fetch(`${CONFIG.BASE_URL}server.php?type=attendance&id=${attendanceId}`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(attendanceData),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Gagal mengupdate data: ${response.statusText}`);
            }
            return response.json();
        })
        .then((data) => {
            if (data.message === "Attendance updated successfully") {
                alert("Data absensi berhasil diperbarui!");
                // Tutup modal setelah data berhasil diperbarui
                const modal = document.getElementById("modalEditAbsensi");
                const modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();
                // Muat ulang tabel data
                loadAttendance();
            } else {
                alert(`Gagal mengupdate data: ${data.message}`);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat mengupdate data.");
        });
}

// Fungsi untuk mengisi data ke modal edit
function fillEditForm(attendanceId, studentId, activityId, attendanceDate, status, checkInTime, notes) {
    // Isi data ke dalam input field
    document.getElementById("edit_id_absen").value = attendanceId;
    document.getElementById("edit_tanggal_absen").value = attendanceDate;
    document.getElementById("edit_status_absen").value = status;
    document.getElementById("edit_check_in_time").value = checkInTime || "";
    document.getElementById("edit_notes").value = notes || "";

    // Muat data siswa dan pilih data yang sesuai
    const studentsEndpoint = `${CONFIG.BASE_URL}server.php?type=students`;
    fetch(studentsEndpoint)
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Gagal mengambil data siswa: ${response.statusText}`);
            }
            return response.json();
        })
        .then((students) => {
            const dropdownSiswa = document.getElementById("edit_id_siswa");
            dropdownSiswa.innerHTML = `<option value="" disabled>Pilih Siswa</option>`; // Reset opsi
            students.forEach((student) => {
                const option = document.createElement("option");
                option.value = student.student_id;
                option.textContent = `${student.student_id} - ${student.name}`;
                if (student.student_id === studentId) {
                    option.selected = true; // Pilih siswa yang sesuai
                }
                dropdownSiswa.appendChild(option);
            });
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Gagal memuat data siswa.");
        });

    // Muat data aktivitas dan pilih data yang sesuai
    const activitiesEndpoint = `${CONFIG.BASE_URL}server.php?type=Activities`;
    fetch(activitiesEndpoint)
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Gagal mengambil data aktivitas: ${response.statusText}`);
            }
            return response.json();
        })
        .then((activities) => {
            const dropdownAktivitas = document.getElementById("edit_id_aktivitas");
            dropdownAktivitas.innerHTML = `<option value="" disabled>Pilih Aktivitas</option>`; // Reset opsi
            activities.forEach((activity) => {
                const option = document.createElement("option");
                option.value = activity.activity_id;
                option.textContent = `${activity.activity_id} - ${activity.name}`;
                if (activity.activity_id === activityId) {
                    option.selected = true; // Pilih aktivitas yang sesuai
                }
                dropdownAktivitas.appendChild(option);
            });
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Gagal memuat data aktivitas.");
        });
}

// Fungsi untuk menghapus data attendance
function deleteAttendance(attendanceId) {
    if (!confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        return; // Batalkan penghapusan jika pengguna membatalkan konfirmasi
    }

    const endpoint = `${CONFIG.BASE_URL}server.php?type=attendance&id=${attendanceId}`;

    fetch(endpoint, {
        method: "DELETE",
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Gagal menghapus data: ${response.statusText}`);
            }
            return response.json();
        })
        .then((data) => {
            if (data.message === "Attendance deleted successfully") {
                alert("Data absensi berhasil dihapus!");
                // Muat ulang tabel data setelah penghapusan
                loadAttendance();
            } else {
                alert(`Gagal menghapus data: ${data.message}`);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat menghapus data.");
        });
}
