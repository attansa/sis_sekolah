<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title>Monitoring Absensi</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="assets/dist/css/adminlte.min.css">

<script src="assets/plugins/jquery/jquery.min.js"></script>

<style>

body{

    background:#f4f6f9;

}

.nama{

    font-size:40px;
    font-weight:bold;

}

.role{

    font-size:28px;

}

.jam{

    font-size:55px;
    color:#007bff;
    font-weight:bold;

}

.status{

    font-size:30px;

}

</style>

</head>

<body>

<div class="container mt-4">

<div class="row">

<div class="col-md-12">

<div class="card card-success">

<div class="card-header">

<h3>

MONITORING ABSENSI RFID

</h3>

</div>

<div class="card-body text-center">

<div class="nama" id="nama">

MENUNGGU RFID...

</div>

<div class="role mt-3" id="role">

-

</div>

<div class="jam mt-4" id="jam">

--

</div>

<div class="mt-4">

<span
id="status"
class="badge badge-success status">

Belum Ada Scan

</span>

</div>

</div>

</div>

</div>

</div>

<hr>

<div class="row">

<div class="col-md-12">

<div class="card">

<div class="card-header">

<h4>

10 Scan Terakhir

</h4>

</div>

<div class="card-body">

<table class="table table-bordered" id="history">

<thead>

<tr>

<th>No</th>

<th>Nama</th>

<th>Role</th>

<th>Tanggal</th>

<th>Jam Masuk</th>

<th>Jam Keluar</th>

<th>Status</th>

</tr>

</thead>

<tbody>

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

<script>

let lastID=0;

function loadData(){

    $.getJSON("api/last_absensi.php",function(res){

        if(!res.status){

            return;

        }

        if(lastID==res.data.id){

            return;

        }

        lastID=res.data.id;

        $("#nama").text(res.data.nama);

        $("#role").text(res.data.role.toUpperCase());

        if(res.data.jam_keluar==null){

            $("#jam").text(res.data.jam_masuk);

        }else{

            $("#jam").text(res.data.jam_keluar);

        }

        $("#status").text(res.data.status.toUpperCase());

        tambahHistory(res.data);

    });

}

function tambahHistory(data){

    let nomor=$("#history tbody tr").length+1;

    let row=`
<tr>

<td>${nomor}</td>

<td>${data.nama}</td>

<td>${data.role}</td>

<td>${data.tanggal}</td>

<td>${data.jam_masuk}</td>

<td>${data.jam_keluar ?? '-'}</td>

<td>${data.status}</td>

</tr>`;

    $("#history tbody").prepend(row);

    if($("#history tbody tr").length>10){

        $("#history tbody tr:last").remove();

    }

}

setInterval(loadData,1000);

</script>

</body>

</html>