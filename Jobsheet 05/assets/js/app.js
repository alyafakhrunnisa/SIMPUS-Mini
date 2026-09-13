// function initNavToggle() {
//     const toggleBtn = document.getElementById("nav-toggle-btn");
//     const nav = document.querySelector("header nav");
//     if (!toggleBtn || !nav) return;

//     toggleBtn.addEventListener("click", function () {
//         nav.classList.toggle("nav-open");
//     });
// }

// function initHapusConfirm() {
//     document.querySelectorAll(".btn-hapus-aes").forEach(function (btn) {
//         btn.addEventListener("click", function () {
//             const row = btn.closest("tr");
//             const nama = row ? row.querySelector("td")?.textContent : "data ini";
//             const yakin = confirm("Yakin ingin menghapus \"" + nama + "\"?");
//             if (yakin && row) {
//                 row.remove();
//             }
//         });
//     });
// }

// function initTableFilter() {
//     const input = document.getElementById("search-input");
//     const table = document.querySelector(".table-responsive table");
//     if (!input || !table) return;

//     input.addEventListener("keyup", function () {
//         const keyword = input.value.toLowerCase();
//         const rows = table.querySelectorAll("tbody tr");
//         rows.forEach(function (row) {
//             const teks = row.textContent.toLowerCase();
//             row.style.display = teks.includes(keyword) ? "" : "none";
//         });
//     });
// }

// function tampilkanError(input, pesan) {
//     hapusError(input);
//     const span = document.createElement("span");
//     // Menambahkan class text-danger bawaan Bootstrap untuk warna merah
//     span.className = "error text-danger d-block mt-1 small";
//     span.textContent = pesan;
//     input.insertAdjacentElement("afterend", span);
// }

// function hapusError(input) {
//     const next = input.nextElementSibling;
//     if (next && next.classList.contains("error")) {
//         next.remove();
//     }
// }

// function initValidasiForm() {
//     const form = document.getElementById("form-tambah");
//     if (!form) return;

//     form.addEventListener("submit", function (e) {
//         let valid = true;

//         const judul = form.querySelector("[name='judul'], [name='nama']");
//         if (judul && judul.value.trim() === "") {
//             tampilkanError(judul, "Field ini wajib diisi.");
//             valid = false;
//         } else if (judul) {
//             hapusError(judul);
//         }

//         const tahun = form.querySelector("[name='tahun']");
//         if (tahun) {
//             const nilai = parseInt(tahun.value, 10);
//             if (isNaN(nilai) || nilai < 1900 || nilai > 2026) {
//                 tampilkanError(tahun, "Tahun harus di antara 1900-2026.");
//                 valid = false;
//             } else {
//                 hapusError(tahun);
//             }
//         }

//         if (!valid) {
//             e.preventDefault();
//         }
//     });
// }

// document.addEventListener("DOMContentLoaded", function () {
//     initNavToggle();
//     initHapusConfirm();
//     initTableFilter();
//     initValidasiForm();
// });

//Latihan Tambahan 1,3,4,5
// 1. Hamburger Menu 
function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");
    if (!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}

// Latihan 4: Fungsi Update Counter 
function updateCounter() {
    const table = document.querySelector(".table-responsive table");
    const counterDiv = document.getElementById("table-counter");
    if (!table || !counterDiv) return;

    const allRows = table.querySelectorAll("tbody tr");
    let visibleCount = 0;
    let totalCount = 0;

    allRows.forEach(row => {
        totalCount++;
        if (row.style.display !== "none") {
            visibleCount++;
        }
    });

    counterDiv.textContent = `Menampilkan ${visibleCount} dari ${totalCount} data`;
}

//  2. Konfirmasi Hapus + Counter 
function initHapusConfirm() {
    document.querySelectorAll(".btn-hapus-aes").forEach(function (btn) {
        btn.addEventListener("click", function () {
            const row = btn.closest("tr");
            const nama = row ? row.querySelector("td")?.textContent : "data ini";
            const yakin = confirm("Yakin ingin menghapus \"" + nama + "\"?");
            if (yakin && row) {
                row.remove();
                updateCounter(); // Panggil counter tiap ada data yang dihapus
            }
        });
    });
}

// Latihan 3: Filter Tabel (Hanya Kolom Judul/Nama) 
function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");
    if (!input || !table) return;

    input.addEventListener("keyup", function () {
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");
        
        rows.forEach(function (row) {
            // Hanya mencari pada kolom pertama (Judul Buku / Nama Anggota)
            const selPertama = row.querySelector("td");
            const teks = selPertama ? selPertama.textContent.toLowerCase() : "";
            
            row.style.display = teks.includes(keyword) ? "" : "none";
        });
        
        updateCounter(); // Panggil counter setiap kali mencari data
    });
}

// Fungsi Bantuan Validasi Form 
function tampilkanError(input, pesan) {
    hapusError(input);
    const span = document.createElement("span");
    span.className = "error text-danger d-block mt-1 small";
    span.textContent = pesan;
    input.insertAdjacentElement("afterend", span);
}

function hapusError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) {
        next.remove();
    }
}

//  Latihan 1 & 5: Refactor Validasi Form & Validasi ISBN 
function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valid = true;

        // Menggunakan array untuk menghindari penulisan blok if berulang
        const fieldWajib = ["judul", "pengarang", "stok", "nama", "no_anggota", "email"];

        fieldWajib.forEach(function (namaField) {
            const input = form.querySelector(`[name='${namaField}']`);
            if (input) {
                if (input.value.trim() === "") {
                    tampilkanError(input, "Field ini wajib diisi.");
                    valid = false;
                } else {
                    hapusError(input);
                }
            }
        });

        const tahun = form.querySelector("[name='tahun']");
        if (tahun) {
            const nilai = parseInt(tahun.value, 10);
            if (isNaN(nilai) || nilai < 1900 || nilai > 2026) {
                tampilkanError(tahun, "Tahun harus di antara 1900-2026.");
                valid = false;
            } else {
                hapusError(tahun);
            }
        }

        // Validasi ISBN: Hanya memperbolehkan angka dan tanda hubung
        const isbn = form.querySelector("[name='isbn']");
        if (isbn && isbn.value.trim() !== "") {
            const regexIsbn = /^[0-9-]+$/; 
            if (!regexIsbn.test(isbn.value)) {
                tampilkanError(isbn, "ISBN hanya boleh berisi angka dan tanda hubung.");
                valid = false;
            } else {
                hapusError(isbn);
            }
        }

        if (!valid) {
            e.preventDefault();
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initHapusConfirm();
    initTableFilter();
    updateCounter(); 
    initValidasiForm();
});