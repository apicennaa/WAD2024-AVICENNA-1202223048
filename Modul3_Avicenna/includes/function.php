<?php

include("dbconnection.php");

// buatkan function addStudent()
function addStudent()
{
    // variabel global
    global $conn;

    // Silakan buat variabel di bawah dengan data yang diambil dari form
    $mhNama = $_POST['nama'];
    $mhNIM = $_POST['nim'];
    $mhJurusan = $_POST['jurusan'];
    $mhAngkatan = $_POST['angkatan'];

    // Periksa apakah NIM sudah ada
    $ret = mysqli_query($conn, "SELECT * FROM tb_student WHERE NIM = '$mhNIM'");

    if (mysqli_num_rows($ret) == 0) {
        // Masukkan data ke tabel tb_student
        $query = "INSERT INTO tb_student (NIM, nama, jurusan, angkatan) 
        VALUES ('$mhNIM', '$mhNama', '$mhJurusan', '$mhAngkatan')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>alert('Mahasiswa berhasil ditambahkan.');</script>";
            echo "<script>window.location.href = 'add-students.php'</script>";
        } else {
            echo "<script>alert('Please try again.');</script>";
        }
    } else {
        echo "<script>alert('NIM sudah ada.');</script>";
        /**
         * Buatlah logika untuk Memeriksa hasil dari operasi penambahan data mahasiswa.
         * 
         * Jika operasi berhasil, menampilkan pesan bahwa mahasiswa telah ditambahkan
         * dan mengarahkan pengguna ke halaman 'add-students.php'.
         * Jika operasi gagal, menampilkan pesan kesalahan.
         * Jika NIM sudah ada, menampilkan pesan bahwa NIM sudah ada.
         */
        
    }
}

function editStudent($id) {
    global $conn;

    // Ambil input dari form dan simpan dalam variabel
    $mhNama = $_POST['nama'];
    $mhNIM = $_POST['nim'];
    $mhJurusan = $_POST['jurusan'];
    $mhAngkatan = $_POST['angkatan'];

    // Isi query dibawah untuk update data mahasiswa berdasarkan ID
    $query = "UPDATE tb_student (NIM, nama, jurusan, angkatan) 
        VALUES ('$mhNIM', '$mhNama', '$mhJurusan', '$mhAngkatan')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script>alert("Student data has been updated.")</script>';
        echo "<script>window.location.href ='manage-students.php'</script>";
    } else {
        echo '<script>alert("Something Went Wrong. Please try again.")</script>';
    }
}


?>