async function muatDaftarArena() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise((resolve) => setTimeout(resolve, 1000));
        const res = await fetch("../data/arena.json");
        if (!res.ok) throw new Error("Gagal mengambil data arena");
        
        const daftarArena = await res.json();
        daftarArena.forEach(function (arena) {
            const tr = document.createElement("tr");
            let badgeStatus = arena.status === "Tersedia" 
                ? `<span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">Tersedia</span>` 
                : `<span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3">Dipakai</span>`;

            tr.innerHTML =
                '<td class="ps-4 py-3 fw-bold text-aesthetic">' + arena.nama + '</td>' +
                '<td class="py-3 text-secondary">' + arena.kategori + '</td>' +
                '<td class="py-3 fw-medium">Rp ' + arena.harga.toLocaleString('id-ID') + '/jam</td>' +
                '<td class="py-3 text-center">' + badgeStatus + '</td>' +
                '<td class="py-3 text-center">' +
                    '<button type="button" class="btn btn-edit-aes btn-sm rounded-pill px-3 mb-1"><i class="bi bi-pencil-square"></i></button> ' +
                    '<button type="button" class="btn btn-hapus-aes btn-sm rounded-pill px-3 mb-1"><i class="bi bi-trash"></i></button>' +
                '</td>';
            tbody.appendChild(tr);
        });
    } catch (err) {
        tbody.innerHTML = '<tr><td colspan="5" class="text-center text-danger py-4">Gagal memuat data: ' + err.message + '</td></tr>';
    } finally {
        loading.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", muatDaftarArena);
document.getElementById("btn-muat-ulang")?.addEventListener("click", muatDaftarArena);