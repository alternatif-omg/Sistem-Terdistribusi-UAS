// Panggil loadActivities saat halaman dimuat
document.addEventListener("DOMContentLoaded", () => {
    loadActivities();
});

function loadActivities() {
    const endpoint = `${CONFIG.BASE_URL}server.php?type=Activities`;

    // Fetch data dari endpoint
    fetch(endpoint)
        .then((response) => {
            if (!response.ok) {
                throw new Error("Gagal mengambil data: " + response.statusText);
            }
            return response.json();
        })
        .then((data) => {
            const tbody = document.getElementById("datatable").querySelector("tbody");
            tbody.innerHTML = ""; // Kosongkan isi tabel sebelum memuat data baru

            // Iterasi setiap aktivitas dan tambahkan ke tabel
            data.forEach((activity) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${activity.activity_id}</td>
                    <td>${activity.name}</td>
                    <td>${truncateString(activity.description, 35)}</td>
                    <td>${activity.schedule}</td>
                    <td>${activity.Instructor}</td>
                    <td>
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditKegiatan" 
                            onclick="fillEditForm('${activity.activity_id}', '${activity.name}', '${activity.description}', '${activity.schedule}', '${activity.Instructor}')">Edit</button>
                        <a href="#" class="btn btn-danger btn-sm" onclick="deleteActivity('${activity.activity_id}')">Hapus</a>
                    </td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch((error) => {
            console.error("Terjadi kesalahan:", error);
            alert("Gagal memuat data. Silakan coba lagi.");
        });
}

// Fungsi untuk menghapus aktivitas
function deleteActivity(activityId) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        fetch(`${CONFIG.BASE_URL}server.php?type=Activities&id=${activityId}`, {
            method: "DELETE",
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`Gagal menghapus data: ${response.statusText}`);
                }
                return response.json();
            })
            .then((data) => {
                if (data.message === "Activity deleted successfully") {
                    alert("Data berhasil dihapus.");
                    // Panggil kembali fungsi untuk memuat ulang data
                    loadActivities();
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

// Fungsi untuk menambahkan data kegiatan
function addActivity() {
    // Ambil data dari form
    const nama = document.getElementById("nama_kegiatan").value;
    const jadwal = document.getElementById("jadwal_kegiatan").value;
    const deskripsi = document.getElementById("deskripsi_kegiatan").value;
    const instruktur = document.getElementById("instruktur_kegiatan").value;

    // Validasi form
    if (!nama || !jadwal || !deskripsi || !instruktur) {
        alert("Mohon lengkapi semua data!");
        return;
    }

    const generateRandomId = () => Math.floor(200000 + Math.random() * 299999).toString();

    // Data yang akan dikirim
    const activityData = {
        activity_id: generateRandomId(), // Menggunakan timestamp sebagai ID sementara
        name: nama,
        description: deskripsi,
        schedule: jadwal,
        instructor: instruktur,
    };

    // Kirim data ke server
    fetch(`${CONFIG.BASE_URL}server.php?type=Activities`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(activityData),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Gagal menambahkan data: ${response.statusText}`);
            }
            return response.json();
        })
        .then((data) => {
            if (data.message == "Activity created successfully") {
                alert("Data berhasil ditambahkan.");

                // Reset form setelah data berhasil ditambahkan
                document.getElementById("nama_kegiatan").value = "";
                document.getElementById("jadwal_hari").value = "";
                document.getElementById("jadwal_mulai").value = "";
                document.getElementById("jadwal_berakhir").value = "";
                document.getElementById("jadwal_kegiatan").value = "";
                document.getElementById("deskripsi_kegiatan").value = "";
                document.getElementById("instruktur_kegiatan").value = "";
                const modal = bootstrap.Modal.getInstance(document.getElementById("modalTambahKegiatan"));
                modal.hide();
                // Muat ulang tabel data
                loadActivities();
            } else {
                alert(`Gagal menambahkan data: ${data.message}`);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat menambahkan data.");
        });
}

// Fungsi untuk mengupdate data kegiatan
function updateActivity() {
    // Ambil data dari form
    const id = document.getElementById("edit_id_kegiatan").value;
    const nama = document.getElementById("edit_nama_kegiatan").value;
    const hari = document.getElementById("edit_jadwal_hari").value;
    const jamMulai = document.getElementById("edit_jadwal_mulai").value;
    const jamBerakhir = document.getElementById("edit_jadwal_berakhir").value;
    const deskripsi = document.getElementById("edit_deskripsi_kegiatan").value;
    const instruktur = document.getElementById("edit_instruktur_kegiatan").value;

    // Validasi form
    if (!id || !nama || !hari || !jamMulai || !jamBerakhir || !deskripsi || !instruktur) {
        alert("Mohon lengkapi semua data!");
        return;
    }

    // Format jadwal dari input hari dan jam
    const jadwal = `${hari}, ${jamMulai}-${jamBerakhir}`;

    // Data yang akan dikirim
    const activityData = {
        activity_id: id,
        name: nama,
        description: deskripsi,
        schedule: jadwal,
        instructor: instruktur,
    };

    // Kirim data ke server
    fetch(`${CONFIG.BASE_URL}server.php?type=Activities&id=${id}`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(activityData),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Gagal mengupdate data: ${response.statusText}`);
            }
            return response.json();
        })
        .then((data) => {
            if (data.message === "Activity updated successfully") {
                alert("Data berhasil diperbarui.");
                // Tutup modal setelah data berhasil diperbarui
                const modal = bootstrap.Modal.getInstance(document.getElementById("modalEditKegiatan"));
                modal.hide();

                // Muat ulang tabel data
                loadActivities();
            } else {
                alert(`Gagal memperbarui data: ${data.message}`);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat memperbarui data.");
        });
}

function fillEditForm(id, nama, deskripsi, jadwal, instruktur) {
    // Set ID, Nama Kegiatan, Deskripsi, dan Instruktur
    console.log({ id, nama, deskripsi, jadwal, instruktur }); // Debug

    document.getElementById('edit_id_kegiatan').value = id;
    document.getElementById('edit_nama_kegiatan').value = nama;
    document.getElementById('edit_deskripsi_kegiatan').value = deskripsi;
    document.getElementById('edit_instruktur_kegiatan').value = instruktur;

    // Pisahkan jadwal ke dalam Hari, Jam Mulai, dan Jam Berakhir
    const [hari, jamRange] = jadwal.split(', '); // Contoh: "Senin, 16:00-18:00"
    const [jamMulai, jamBerakhir] = jamRange.split('-'); // Contoh: "16:00-18:00"

    // Set input Hari, Jam Mulai, dan Jam Berakhir
    document.getElementById('edit_jadwal_hari').value = hari;
    document.getElementById('edit_jadwal_mulai').value = jamMulai;
    document.getElementById('edit_jadwal_berakhir').value = jamBerakhir;

    // Update field Jadwal secara otomatis
    generateEditJadwal();
}

function generateJadwal() {
    const hari = document.getElementById('jadwal_hari').value;
    const mulai = document.getElementById('jadwal_mulai').value;
    const berakhir = document.getElementById('jadwal_berakhir').value;

    if (hari && mulai && berakhir) {
        document.getElementById('jadwal_kegiatan').value = `${hari}, ${mulai}-${berakhir}`;
    }
}

function generateEditJadwal() {
    const hari = document.getElementById('edit_jadwal_hari').value;
    const mulai = document.getElementById('edit_jadwal_mulai').value;
    const berakhir = document.getElementById('edit_jadwal_berakhir').value;

    if (hari && mulai && berakhir) {
        document.getElementById('edit_jadwal_kegiatan').value = `${hari}, ${mulai}-${berakhir}`;
    }
}

function truncateString(str, maxLength) {
    if (str.length > maxLength) {
        return str.substring(0, maxLength) + "...";
    }
    return str;
}
