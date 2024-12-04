<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3 class="text-center mb-4">Search Mahasiswa</h3>

    <!-- Form Pencarian -->
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <form method="GET" action="" class="d-flex">
                <input type="text" class="form-control me-2" name="search" placeholder="Cari NIM atau Nama Mahasiswa" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                <button class="btn btn-primary" type="submit">Cari</button>
            </form>
        </div>
    </div>

    <!-- Tombol Tambah Data -->
    <div class="d-flex justify-content-between mb-3">
        <button type="button" class="btn btn-primary" onclick="window.location.href='../dashboard.php'">Kembali</button>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Data</button>
    </div>
    

    <!-- Tabel Data Mahasiswa -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>NIM</th>
                    <th>Nama Lengkap</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Prodi</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';
                $no = 1;
                $search = isset($_GET['search']) ? $_GET['search'] : '';

                if ($search) {
                    $tampil = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim LIKE '%$search%' OR nama LIKE '%$search%' ORDER BY id_mhs DESC");
                } else {
                    $tampil = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY id_mhs DESC");
                }

                while ($data = mysqli_fetch_array($tampil)) :
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($data['nim']) ?></td>
                    <td><?= htmlspecialchars($data['nama']) ?></td>
                    <td><?= htmlspecialchars($data['alamat']) ?></td>
                    <td><?= htmlspecialchars($data['jenis_kelamin']) ?></td>
                    <td><?= htmlspecialchars($data['prodi']) ?></td>
                    <td><img src="../uploads/<?= htmlspecialchars($data['foto']) ?>" alt="Foto" class="img-thumbnail" 
                    width="50" style="cursor: pointer;" data-bs-toggle="modal" 
                    data-bs-target="#modalFoto<?= $data['id_mhs'] ?>"></td>
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
                                <img src="../uploads/<?= $data['foto'] ?>" alt="Foto" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>

                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
