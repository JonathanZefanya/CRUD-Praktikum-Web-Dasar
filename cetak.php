<?php
//panggil database
include "database/koneksi.php";
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Data Mahasiswa</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<style>
    @media print {
        .no-print, .no-print *
        {
            display:none !important;
        }
    }
</style>

</head>
<body>
    <div class="container">
        
            <div class="card mt-5">
        <div class="card-header bg-primary text-white">
            Data Mahasiswa
        </div>
        
        <div class="card-body">
        <div class="no-print">
            <!-- Button trigger -->
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
            Tambah Data</button>
            <a href="index.php" class="btn btn-primary mb-3">Data Mahasiswa</a>
        </div>

        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>No.</th>
                <th>Nim</th>
                <th>Nama Lengkap</th>
                <th>Alamat</th>
                <th>Jenis Kelamim</th>
                <th>Prodi</th>
                <th>Foto</th>
            </tr> 
            <?php
            //Persiapan menampilkan data
            $no=1;
            $tampil = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY id_mhs DESC ");
            while  ($data = mysqli_fetch_array($tampil)) :
            ?>

            <tr>
                <td><?= $no++ ?></td>
                <td><?= $data ['nim'] ?></td>
                <td><?= $data ['nama'] ?></td>
                <td><?= $data ['alamat']?></td>
                <td><?= $data ['jenis_kelamin']?></td>
                <td><?= $data ['prodi']?></td>
                <td><img src="uploads/<?= $data['foto'] ?>" alt="Foto" width="50"></td>
                
            </tr>
            
            <?php endwhile; ?>

        </table>

        
                
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script>
		window.print();
</script>
</body>
</html>