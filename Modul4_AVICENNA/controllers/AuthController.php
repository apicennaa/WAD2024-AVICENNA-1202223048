<?php

class AuthController
{
    private $conn;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        require_once 'config/database.php';
        $this->conn = $conn;
    }

    public function login()
    {
        if (isset($_POST['submit'])) {
            $nim = $input['nim'];
            $password = $input['password'];
        
            $query = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 1) {
                $data = mysql_fetch_assoc($result);

                if (password_verify($password, $data['password'])) {
                    $_SESSION["login"] = true;
                    $_SESSION["user"] = $data;
                    $_SESSION["message"] = "Login Berhasil";

                    if (isset($input["remember"])) {
                        setcookie("nim", $data, time() + (86400 * 30), "/");
                        setcookie("password", $data, time() + (86400 * 30), "/");
                    } else {
                        setcookie("nim", "", time() - 3600, "/");
                        setcookie("password", "", time() - 3600, "/");
                    }

                    header("Location: index.php?controller=dashboard&action=index");
                    exit;
                } else {
                    $_SESSION['message'] = "Login Gagal NIM atau Password Salah";
                }
            } else {
                $_SESSION['message']= "NIM Tidak Ditemukan";
            }
        }
                    // TODO: Lengkapi fungsi login dengan langkah berikut:
            // 1. Ambil nim dan password dari form login
            // 2. Buat query untuk mencari mahasiswa berdasarkan NIM
            // 3. Eksekusi query menggunakan mysqli_query
            // 4. Ambil hasil query menggunakan mysqli_fetch_assoc
            // 5. Cek apakah mahasiswa ditemukan
            // 6. Jika ditemukan, verifikasi password menggunakan password_verify
            // 7. Jika password benar:
            //    - Set session login = true
            //    - Set session user dengan data mahasiswa
            //    - Set session message dengan "Login Berhasil"
            //    - Jika remember_me dicentang, buat cookie untuk nim dan password
            //    - Redirect ke halaman dashboard menggunakan (header('Location: index.php?controller=dashboard&action=index'))
            //    - Jangan lupa exit setelah redirect
            // 8. Jika password salah, set session message "Login Gagal NIM atau Password Salah"
            // 9. Jika mahasiswa tidak ditemukan, set session message "NIM Tidak Ditemukan"
        include 'views/auth/login.php';
    }

    private function getJurusan($jurusan){
        // TODO: Lengkapi fungsi untuk mendapatkan kode jurusan
        // 1. Buat variabel $kode_jurusan dengan nilai default 0
        $kode_jurusan == 0;
        // 2. Gunakan switch-case atau if-else untuk mengatur kode jurusan:
            if ($jurusan = "Kedokteran") {
                $kode_jurusan = 11;
            } elseif ($jurusan = "Psikologi") {
                $kode_jurusan = 12;
            } elseif ($jurusan = "Biologi") {
                $kode_jurusan = 13;
            } elseif ($jurusan = "Teknik Informatika") {
                $kode_jurusan = 14;
            }
        //    - kedokteran = 11
        //    - psikologi = 12
        //    - biologi = 13
        //    - teknik informatika = 14
        // 3. Return nilai kode_jurusan
    }

    private function generateNIM($id_pendaftaran){
        // TODO: Lengkapi fungsi untuk generate NIM dengan format: [kode_jurusan][tahun_masuk][id_pendaftaran]
        // 1. Buat query untuk mengambil data pendaftaran berdasarkan id_pendaftaran
        $query = "SELECT * FROM pendaftaran WHERE id = '$id_pendaftaran'";
        // 2. Eksekusi query dan ambil hasilnya
        $result = mysqli_query($conn, $query);
        // 3. Ambil tahun sekarang dalam format 2 digit menggunakan date('y')
        $tahun = date("y");
        // 4. Jika data ditemukan:
        if (mysqli_num_rows($result) == 1) {
            $data = mysql_fetch_assoc($result);
        //    - Ambil data jurusan dari hasil query
            $jurusan = $data['jurusan'];
        //    - Dapatkan kode jurusan menggunakan fungsi getJurusan()
            $kode_jurusan = getJurusan($jurusan);
        //    - Jika kode jurusan valid (tidak 0):
                if ($kode_jurusan != 0) {
        //      * Generate NIM dengan format: [kode_jurusan][tahun][id_pendaftaran_dengan_padding]
                    $nim = $kode_jurusan.$tahun.$id_pendaftaran;
                } else {
                    return false;
                }
        } else {
            return false;
        } }
        //      * Gunakan str_pad untuk id_pendaftaran 2 digit
        //    - Return false jika kode jurusan tidak valid
        // 5. Return false jika data tidak ditemukan

    public function register_step_1()
    {
        if (isset($_POST['submit'])) {
            // TODO: Lengkapi fungsi register step 1
            $id_pendaftaran = $_POST['id_pendaftaran'];
            // 1. Ambil id_pendaftaran dari form register step 1
            $query = "SELECT * FROM pendaftaran WHERE id = $id_pendaftaran and status = 'lulus'";
            // 2. Buat query untuk mencari pendaftaran berdasarkan id_pendaftaran dengan status 'lulus'
            $result = mysqli_query($conn, $query);
            // 3. Eksekusi query dan ambil hasilnya
            if (mysqli_num_rows($result) == 1) {
                $data = mysql_fetch_assoc($result);
            // 4. Jika ditemukan:
                $_SESSION["id_pendaftaran"] = $id_pendaftaran;
            //    - Set session id_pendaftaran dengan id_pendaftaran
                header("Location: index.php?controller=auth&action=register_step_2");
            //    - Redirect ke register step 2 menggunakan (header('Location: index.php?controller=auth&action=register_step_2'))
                exit;
            //    - Jangan lupa exit setelah redirect
            } else {
                $_SESSION['message'] = "Error";
            }
            // 5. Jika tidak ditemukan, set session message error
        }
        
        include 'views/auth/register_step_1.php';
    }

    public function register_step_2() 
    {
        // TODO: Cek apakah id_pendaftaran sudah ada di session
        if (isset($_SESSION['id_pendaftaran'])) {
            header("Location: index.php?controller=auth&action=register_step_1");
            exit;
        }
        // 1. Jika id_pendaftaran belum ada di session:
        //    - Redirect ke halaman register step 1
        //    - Gunakan header('Location: index.php?controller=auth&action=register_step_1')
        //    - Jangan lupa exit setelah redirect

        if (isset($_POST['submit'])) {
            // TODO: Ambil data dari form register step 2
            // 1. Ambil password dari form
            $password = $input['password'];
            // 2. Ambil confirm_password dari form
            $confirm_password = $input['confirm_password'];
            // TODO: Validasi password
            if ($password == $confirm_password){
            // 1. Cek apakah password sama dengan confirm_password
            // 2. Jika sama:
                $id_pendaftaran = $_SESSION['id_pendaftaran'];
            //    - Ambil id_pendaftaran dari session
                $query = "SELECT * FROM pendaftaran WHERE 'id'";
            //    - Buat query untuk mengambil data pendaftaran berdasarkan id_pendaftaran
                $result = mysqli_query($conn, $query);
            //    - Eksekusi query menggunakan mysqli_query
            if (mysqli_num_rows($result) == 1) {
                $data = mysql_fetch_assoc($result);
                $nim = generateNIM($id_pendaftaran);
            } }
            //    - Ambil hasil query menggunakan mysqli_fetch_assoc
            //    - Generate NIM menggunakan fungsi generateNIM()
            //    
            //    - Buat query untuk cek apakah NIM sudah ada di database
            //    - Eksekusi query cek NIM
            //    - Jika NIM sudah ada:
            //      * Set session message "NIM sudah terdaftar"
            //    - Jika NIM belum ada:
            //      * Hash password menggunakan password_hash dengan PASSWORD_DEFAULT
            //      * Ambil nama dan jurusan dari data pendaftaran
            //      * Buat query INSERT untuk menyimpan data mahasiswa (nim, id_pendaftaran, password, nama, jurusan)
            //      * Eksekusi query INSERT
            //      * Jika berhasil:
            //        - Set session message berisi informasi berhasil dan NIM
            //        - Hapus session id_pendaftaran
            //        - Redirect ke halaman login menggunakan header('Location: index.php?controller=auth&action=login')
            //        - Exit setelah redirect
            //      * Jika gagal:
            //        - Set session message "Register Gagal"
            // 3. Jika password tidak sama:
            //    - Set session message "Password Tidak Cocok"
        }

        include 'views/auth/register_step_2.php';
    } 

    public function logout() 
    {
        // TODO: Implementasikan fungsi logout
        // 1. Hapus semua data session
        // 2. Redirect ke halaman login dengan:
        //    - Gunakan header('Location: index.php?controller=auth&action=login')
        //    - Jangan lupa exit setelah redirect
                
    }
}

?>