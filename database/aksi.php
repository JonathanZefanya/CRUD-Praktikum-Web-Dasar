<?php
// koneksi
include "koneksi.php";

function uploadFile($file, $folder) {
    $target_dir = "../$folder/";

    // Buat nama file unik untuk menghindari konflik
    $unique_name = uniqid() . '_' . basename($file["name"]);
    $target_file = $target_dir . $unique_name;

    // Pastikan folder upload tersedia
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Pindahkan file dan cek apakah berhasil diunggah
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $unique_name; // Kembalikan nama file yang disimpan
    }
    return null;
}

// Simpan data baru
if (isset($_POST['saving'])) {
    $foto = uploadFile($_FILES['tfoto'], 'uploads');

    // Periksa apakah foto berhasil diunggah
    if ($foto !== null) {
        $simpan = mysqli_query($koneksi, "INSERT INTO mahasiswa (nim, nama, alamat, jenis_kelamin, prodi, foto)
                                           VALUES ('$_POST[tnim]',
                                                   '$_POST[tnama]',
                                                   '$_POST[talamat]',
                                                   '$_POST[tjk]',
                                                   '$_POST[tprodi]',
                                                   '$foto')");
        if ($simpan) {
            echo "<script>alert('Simpan data sukses'); document.location='../dashboard.php';</script>";
        } else {
            echo "<script>alert('Simpan data gagal: " . mysqli_error($koneksi) . "'); document.location='../dashboard.php';</script>";
        }
    } else {
        echo "<script>alert('Gagal mengunggah foto'); document.location='../dashboard.php';</script>";
    }
}

// Ubah data
if (isset($_POST['changing'])) {
    $foto = $_FILES['tfoto']['name'] ? uploadFile($_FILES['tfoto'], 'uploads') : $_POST['old_foto'];
    $ubah = mysqli_query($koneksi, "UPDATE mahasiswa SET 
                                nim = '$_POST[tnim]',
                                nama = '$_POST[tnama]',
                                alamat = '$_POST[talamat]',
                                jenis_kelamin = '$_POST[tjk]',
                                prodi = '$_POST[tprodi]',
                                foto = '$foto'
                                WHERE id_mhs = '$_POST[id_mhs]'");
    if ($ubah) {
        echo "<script>alert('Ubah data sukses'); document.location='../dashboard.php';</script>";
    } else {
        echo "<script>alert('Ubah data gagal: " . mysqli_error($koneksi) . "'); document.location='../dashboard.php';</script>";
    }
}

// Hapus data
if (isset($_POST['deleting'])) {
    // Ambil nama file foto dari database sebelum menghapus data
    $query = mysqli_query($koneksi, "SELECT foto FROM mahasiswa WHERE id_mhs = '$_POST[id_mhs]'");
    $data = mysqli_fetch_array($query);
    $foto = $data['foto'];

    // Hapus data mahasiswa dari database
    $hapus = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id_mhs = '$_POST[id_mhs]'");

    if ($hapus) {
        // Cek dan hapus file foto dari folder 'uploads'
        $file_path = "../uploads/" . $foto;
        if (file_exists($file_path) && is_file($file_path)) {
            unlink($file_path); // Menghapus file
        }

        echo "<script>alert('Hapus data sukses'); document.location='../dashboard.php';</script>";
    } else {
        echo "<script>alert('Hapus data gagal: " . mysqli_error($koneksi) . "'); document.location='../dashboard.php';</script>";
    }
}
?>