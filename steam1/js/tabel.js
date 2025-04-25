// filepath: /c:/xampp/htdocs/steam1/js/tabel.js
// Example chart for transaksi
var ctxTransaksi = document.getElementById("transaksiChart").getContext("2d");
var labels = transaksiData.map(function (item) {
  return item.hari;
});
var data = transaksiData.map(function (item) {
  return item.jumlah_transaksi;
});

var transaksiChart = new Chart(ctxTransaksi, {
  type: "bar",
  data: {
    labels: labels,
    datasets: [
      {
        label: "Jumlah Transaksi",
        data: data,
        backgroundColor: "rgba(0, 123, 255, 0.5)",
        borderColor: "rgba(0, 123, 255, 1)",
        borderWidth: 1,
      },
    ],
  },
});

// Example chart for pendapatan
var ctxPendapatan = document.getElementById("pendapatanChart").getContext("2d");
var pendapatanChart = new Chart(ctxPendapatan, {
  type: "line",
  data: {
    labels: ["Januari", "Februari", "Maret", "April"],
    datasets: [
      {
        label: "Pendapatan Bulanan",
        data: [1500, 2200, 1800, 2300],
        backgroundColor: "rgba(40, 167, 69, 0.2)",
        borderColor: "rgba(40, 167, 69, 1)",
        borderWidth: 1,
      },
    ],
  },
});
