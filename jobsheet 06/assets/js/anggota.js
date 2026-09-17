async function muatDaftarAnggota() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    loading.style.display = "block";
    tbody.innerHTML = ""; 

    try {
        await new Promise((resolve) => setTimeout(resolve, 2000));

        const res = await fetch("../data/anggota.json");
        if (!res.ok) {
            throw new Error("Gagal mengambil data (status " + res.status + ")");
        }
        
        const daftarAnggota = await res.json();

        daftarAnggota.forEach(function (anggota) {
            const tr = document.createElement("tr");
  
            tr.innerHTML =
                '<td class="fw-medium text-secondary ps-4">' + anggota.no_anggota + '</td>' +
                '<td class="fw-bold">' + anggota.nama + '</td>' +
                '<td><span class="badge bg-secondary-subtle text-secondary border border-secondary">SIB</span></td>' +
                '<td>' + anggota.alamat + '</td>' +
                '<td>' + anggota.no_hp + '</td>' +
                '<td>2022-XX-XX</td>' +
                '<td class="text-center">' +
                    '<button type="button" class="btn btn-edit-aes btn-sm rounded-pill px-3 mb-1">Edit</button> ' +
                    '<button type="button" class="btn btn-detail-aes btn-sm rounded-pill px-3 mb-1">Detail</button> ' +
                    '<button type="button" class="btn btn-hapus-aes btn-sm rounded-pill px-3 mb-1">Hapus</button>' +
                '</td>';
            tbody.appendChild(tr);
        });
    } catch (err) {
     
        tbody.innerHTML =
            '<tr><td colspan="7" class="text-center text-danger py-4">Gagal memuat data: ' + err.message + '</td></tr>';
    } finally {
       
        loading.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", muatDaftarAnggota);
document.getElementById("btn-muat-ulang").addEventListener("click", muatDaftarAnggota);