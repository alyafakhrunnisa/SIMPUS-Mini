async function muatDaftarBuku() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise((resolve) => setTimeout(resolve, 2000));

        const res = await fetch("../data/buku.json");
        if (!res.ok) throw new Error("Gagal mengambil data (status " + res.status + ")");
        
        const daftarBuku = await res.json();

        daftarBuku.forEach(function (buku) {
            const tr = document.createElement("tr");
            
            // Logika sederhana untuk badge stok
            let badgeStok = '';
            if (buku.stok > 0) {
                badgeStok = '<span class="badge bg-success-subtle text-success border border-success">' + buku.stok + ' Tersedia</span>';
            } else {
                badgeStok = '<span class="badge bg-danger-subtle text-danger border border-danger">Habis</span>';
            }

            tr.innerHTML =
                '<td class="ps-4 py-3 fw-medium">' + buku.judul + '</td>' +
                '<td class="py-3 text-secondary">' + buku.pengarang + '</td>' +
                '<td class="py-3">' + buku.kategori + '</td>' +
                '<td class="py-3">' + buku.isbn + '</td>' +
                '<td class="py-3">' + badgeStok + '</td>' +
                '<td class="py-3 text-center">' +
                    '<button type="button" class="btn btn-edit-aes btn-sm rounded-pill px-3 mb-1">Edit</button> ' +
                    '<button type="button" class="btn btn-detail-aes btn-sm rounded-pill px-3 mb-1">Detail</button> ' +
                    '<button type="button" class="btn btn-hapus-aes btn-sm rounded-pill px-3 mb-1">Hapus</button>' +
                '</td>';
            tbody.appendChild(tr);
        });
    } catch (err) {
        tbody.innerHTML = '<tr><td colspan="6" class="text-center text-danger py-4">Gagal memuat data: ' + err.message + '</td></tr>';
    } finally {
        loading.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", muatDaftarBuku);
document.getElementById("btn-muat-ulang")?.addEventListener("click", muatDaftarBuku);