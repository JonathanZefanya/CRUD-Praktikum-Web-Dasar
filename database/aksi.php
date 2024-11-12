<?php
// koneksi
include "koneksi.php";

function uploadFile($file, $folder) {
    $target_dir = "../$folder/";
    $target_file = $target_dir . basename($file["name"]);
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $file["name"];
    }
    return null;
}

// Simpan data baru
if(isset($_POST['saving'])){
    $foto = uploadFile($_FILES['tfoto'], 'uploads');
    $simpan = mysqli_query($koneksi, "INSERT INTO mahasiswa (nim, nama, alamat, jenis_kelamin, prodi, foto)
                                        VALUES ('$_POST[tnim]',
                                                '$_POST[tnama]',
                                                '$_POST[talamat]',
                                                '$_POST[tjk]',
                                                '$_POST[tprodi]',
                                                '$foto')");
    if($simpan){
        echo "<script> alert('Simpan data sukses');
        document.location='../index.php';
        </script>";    
    } else {
        echo "<script> alert('Simpan data gagal');
        document.location='../index.php';
        </script>";  
    }
}

// Ubah data
if(isset($_POST['changing'])){
    $foto = $_FILES['tfoto']['name'] ? uploadFile($_FILES['tfoto'], 'uploads') : $_POST['old_foto'];
    $ubah = mysqli_query($koneksi, "UPDATE mahasiswa SET 
                                nim = '$_POST[tnim]',
                                nama = '$_POST[tnama]',
                                alamat = '$_POST[talamat]',
                                jenis_kelamin = '$_POST[tjk]',
                                prodi = '$_POST[tprodi]',
                                foto = '$foto'
                                WHERE id_mhs = '$_POST[id_mhs]'
                                ");
    if($ubah){
        echo "<script> alert('Ubah data sukses');
        document.location='../index.php';
        </script>";    
    } else {
        echo "<script> alert('Ubah data gagal');
        document.location='../index.php';
        </script>";  
    }
}

// Hapus data
if(isset($_POST['deleting'])){
    $hapus = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id_mhs = '$_POST[id_mhs]' ");
    if($hapus){
        echo "<script> alert('Hapus data sukses');
        document.location='../index.php';
        </script>";    
    } else {
        echo "<script> alert('Hapus data gagal');
        document.location='../index.php';
        </script>";  
    }
}
?>
