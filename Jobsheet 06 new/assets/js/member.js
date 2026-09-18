async function muatDaftarMember() {
    // Ambil elemen tabel (menggunakan ID tabel-member atau fallback ke tbody biasa)
    const tbody = document.getElementById("tabel-member") || document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    loading.style.display = "block";
    tbody.innerHTML = ""; 

    try {
        // Efek loading buatan biar kelihatan kayak ngambil data dari server betulan
        await new Promise((resolve) => setTimeout(resolve, 1000));

        // Panggil data JSON terbaru
        const res = await fetch("../data/member.json");
        if (!res.ok) {
            throw new Error("Gagal mengambil data (status " + res.status + ")");
        }
        
        const daftarMember = await res.json();

        // Looping data member ke dalam tabel
        daftarMember.forEach(function (member) {
            const tr = document.createElement("tr");

            // Logika Estetik: Bikin badge warna emas buat VIP, abu-abu buat Reguler
            let badgeTipe = member.tipe === "VIP" 
                ? '<span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3"><i class="bi bi-star-fill me-1"></i> VIP</span>' 
                : '<span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-3">Reguler</span>';
  
            tr.innerHTML =
                '<td class="ps-4 py-3 fw-medium text-secondary">' + member.id_member + '</td>' +
                '<td class="py-3 fw-bold text-aesthetic">' + member.nama + '</td>' +
                '<td class="py-3">' + badgeTipe + '</td>' +
                '<td class="py-3">' + member.no_hp + '</td>' +
                '<td class="py-3 text-center">' +
                    '<button type="button" class="btn btn-edit-aes btn-sm rounded-pill px-3 mb-1 hover-lift"><i class="bi bi-pencil-square"></i></button> ' +
                    '<button type="button" class="btn btn-hapus-aes btn-sm rounded-pill px-3 mb-1 hover-lift"><i class="bi bi-trash"></i></button>' +
                '</td>';
            tbody.appendChild(tr);
        });
    } catch (err) {
        tbody.innerHTML =
            '<tr><td colspan="5" class="text-center text-danger py-4"><i class="bi bi-exclamation-triangle me-2"></i>Gagal memuat data: ' + err.message + '</td></tr>';
    } finally {
        loading.style.display = "none";
    }
}

// Jalankan fungsi saat halaman beres dimuat
document.addEventListener("DOMContentLoaded", muatDaftarMember);

// Jalankan saat tombol refresh ditekan (pakai optional chaining ? biar aman kalau tombolnya gak ada)
document.getElementById("btn-muat-ulang")?.addEventListener("click", muatDaftarMember);