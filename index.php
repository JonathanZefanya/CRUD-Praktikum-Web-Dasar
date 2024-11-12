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
</head>
<body>
    <div class="container">
            <div class="card mt-5">
        <div class="card-header bg-primary text-white">
            Data Mahasiswa
        </div>
        <div class="card-body">
        <!-- Button trigger -->
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
        Tambah Data</button>
        
                
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>No.</th>
                <th>Nim</th>
                <th>Nama Lengkap</th>
                <th>Alamat</th>
                <th>Jenis Kelamim</th>
                <th>Prodi</th>
                <th>Foto</th>
                <th>Aksi</th>
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
                <td>
                    <img src="uploads/<?= $data['foto'] ?>" alt="Foto" width="50" style="cursor: pointer;"
                    data-bs-toggle="modal" data-bs-target="#modalFoto<?= $data['id_mhs'] ?>">
                </td>
                <td>
                    <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $no ?>">Ubah</a>
                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $no ?>">Hapus</a>
                </td>
            </tr>

            <!-- Preview Foto -->
            <div class="modal fade" id="modalFoto<?= $data['id_mhs'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Preview Foto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <!-- Menampilkan foto dalam ukuran besar -->
                            <img src="uploads/<?= $data['foto'] ?>" alt="Foto" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
                    

            <!-- Ubah -->
            <div class="modal fade" id="modalUbah<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Form data mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="database/aksi.php" enctype="multipart/form-data">
                <input type="hidden" name="id_mhs" value="<?= $data['id_mhs']?>">
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">NIM</label>
                    <input type="text"
                    class="form-control"
                    name="tnim"
                    value="<?=$data['nim']?>"
                    placeholder="Masukkan NIM">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama lengkap</label>
                    <input type="text"
                    class="form-control"
                    name="tnama"
                    value="<?=$data['nama']?>"
                    placeholder="Masukkan Nama Lengkap">
                </div>
                <div class="mb-3">
                    <textarea class="form-control"name="talamat" rows="3"><?=$data['alamat']?></textarea>
                </div>

                <div class="mb-3">
                <label class="form-label"><input type="radio" name="tjk" value="Laki-laki">Laki-laki</label>    
                <label class="form-label"><input type="radio" name="tjk" value="Perempuan">Perempuan</label>  
                </div>

                <div class="mb-3">
                    <label class="form-label">Prodi</label>
                    <select class="form-select" name="tprodi">
                        <option value="<?= $data['prodi'] ?>"><?= $data['prodi'] ?></option>
                        <option value="S1 - Teknik Informatika">S1 - Teknik Informatika</option>
                        <option value="S1 - Teknik Sipil">S1 - Teknik Sipil</option>
                        <option value="S1 - Manajemen">S1 - Manajemen</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto</label>
                    <input type="file" class="form-control" name="tfoto" accept="image/*" value="<img src="uploads/<?= $data['foto'] ?>" alt="Foto" width="50" "><br>
                    <img src="uploads/<?= $data['foto'] ?>" alt="Foto" width="50">
                </div>

            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="changing">Ubah</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">keluar</button>
                </div>
            </form>
            </div>
            
        </div>
        </div>
        
        <!-- Hapus -->
        <div class="modal fade" id="modalHapus<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalTambahLabel">Konfirmasi Hapus Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="POST" action="database/aksi.php">
            <input type="hidden" name="id_mhs" value="<?= $data['id_mhs']?>">
        <div class="modal-body">
            <h5 class="text-center">Apakah Yakin Menghapus data?</h5>
            <span class="text-denger"><?= $data['nim']?> - <?= $data['nama']?></span>
        </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="deleting">Hapus</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">keluar</button>
            </div>
        </form>
        </div>  
    </div>
    </div>      
            <?php endwhile; ?>
        </table>

        

        <!-- Tambah-->
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Form data mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="database/aksi.php">
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">NIM</label>
                    <input type="text" class="form-control" name="tnim" placeholder="Masukkan NIM">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama lengkap</label>
                    <input type="text" class="form-control" name="tnama" placeholder="Masukkan Nama Lengkap">
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-control" name="talamat" rows="3"></textarea>
                </div>

                <div class="mb-3">
                <label class="form-label"><input type="radio" name="tjk" value="Laki-laki">Laki-laki</label>    
                <label class="form-label"><input type="radio" name="tjk" value="Perempuan">Perempuan</label>  

                <div class="mb-3">
                    <label class="form-label">Prodi</label>
                    <select class="form-select" name="tprodi" >
                        <option value="S1 - Teknik Informatika">S1 - Teknik Informatika</option>
                        <option value="S1 - Teknik Sipil">S1 - Teknik Sipil</option>
                        <option value="S1 - Manajemen">S1 - Manajemen</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto</label>
                    <input type="file" class="form-control" name="tfoto" accept="image/*">
                </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="saving">Simpan</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">keluar</button>
                </div>
            </form>
            </div>
            
        </div>
        </div>
                </div>
                </div>
                <!-- <button type="button" class="btn btn-success mb-3" >Cetak Data Mahasiswa</button> -->
                <a href="cetak.php" class="btn btn-success mb-3">Cetak Data Mahasiswa </a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>