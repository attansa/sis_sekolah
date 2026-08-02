// ======================================================
// DASHBOARD BUBS V1
// ======================================================

let chartAbsensi = null;

// ======================================================
// Membuat Grafik
// ======================================================

function loadChart() {

    const canvas = document.getElementById("grafikAbsensi");

    if (!canvas || typeof grafikData === "undefined") {
        return;
    }

    // Hapus chart lama jika ada
    if (chartAbsensi) {
        chartAbsensi.destroy();
    }

    chartAbsensi = new Chart(canvas, {

        type: "line",

        data: {

            labels: grafikData.labels,

            datasets: [

                {

                    label: "Jumlah Kehadiran",

                    data: grafikData.total,

                    borderWidth: 3,

                    fill: true,

                    tension: 0.3

                }

            ]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {

                    display: true

                }

            }

        }

    });

}

// ======================================================
// Monitoring Live RFID
// ======================================================

function loadLive() {

    fetch("api/live_absensi.php")

    .then(response => response.json())

    .then(data => {

        // ==========================
        // Scan Terakhir
        // ==========================

        if (data.last) {

            const nama = document.getElementById("namaScan");
            const role = document.getElementById("roleScan");
            const masuk = document.getElementById("jamMasuk");
            const keluar = document.getElementById("jamKeluar");

            if (nama) {
                nama.innerHTML = data.last.nama;
            }

            if (role) {
                role.innerHTML = data.last.role;
            }

            if (masuk) {
                masuk.innerHTML = data.last.jam_masuk;
            }

            if (keluar) {
                keluar.innerHTML = data.last.jam_keluar ?? "-";
            }

        }

        // ==========================
        // Monitoring Hari Ini
        // ==========================

        const tbody = document.getElementById("tableAbsensi");

        if (!tbody) {
            return;
        }

        let html = "";

        let no = 1;

        data.riwayat.forEach(item => {

            html += `
                <tr>

                    <td>${no++}</td>

                    <td>${item.nama}</td>

                    <td>${item.role}</td>

                    <td>${item.jam_masuk}</td>

                    <td>${item.jam_keluar ?? "-"}</td>

                    <td>${item.status}</td>

                </tr>
            `;

        });

        tbody.innerHTML = html;

    })

    .catch(error => {

        console.error("Live Dashboard Error :", error);

    });

}

// ======================================================
// Inisialisasi
// ======================================================

document.addEventListener("DOMContentLoaded", function () {

    // Grafik
    loadChart();

    // Data Live
    loadLive();

    // Refresh data live tiap 2 detik
    setInterval(loadLive, 2000);

    // Refresh halaman tiap 30 detik
    setInterval(function () {

        location.reload();

    }, 30000);

});