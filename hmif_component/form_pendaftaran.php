<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registrasi - HMIF STTMI MALANG</title>

    <!-- Custom fonts for this template-->
    <link href="assets3/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets3/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body.bg_register {
            background-color: #f6f9ff;
        }
    </style>

</head>

<body class="bg_register">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-md-7">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Registrasi Anggota Baru HMIF!</h1>
                                    </div>
                                    <form class="user needs-validation" novalidate action="peserta/dashboard.php" method="POST">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Lengkap Anda..." required>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir Anda..." required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" placeholder="Tanggal Lahir Anda..." required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                                <div class="form-check">
                                                    <input type="radio" name="jenis_kelamin" value="L" class="form-check-input" id="laki" required>
                                                    <label for="laki" class="form-check-label">Laki-Laki</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="jenis_kelamin" value="P" class="form-check-input" id="perempuan" required>
                                                    <label for="perempuan" class="form-check-label">Perempuan</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="agama">Agama</label>
                                                <select name="agama" id="agama" class="form-control" required>
                                                    <option value="">Pilih Agama</option>
                                                    <option value="islam">Islam</option>
                                                    <option value="kristen">Kristen</option>
                                                    <option value="katholik">Katholik</option>
                                                    <option value="hindu">Hindu</option>
                                                    <option value="budha">Budha</option>
                                                    <option value="konghucu">Konghucu</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                                        </div>

                                         <div class="form-group">
                                            <label for="nim">NIM</label>
                                            <input type="number" name="nim" class="form-control" id="nim" placeholder="Masukkan NIM Lengkap Anda..." required>
                                        </div>

                                        <div class="form-group">
                                            <label for="asal_prodi">Asal Prodi</label>
                                            <select name="keahlian" id="keahlian" class="form-control" required>
                                                <option value="" disabled selected hidden>Pilih Prodi</option>
                                                <option value="Teknik Informatika">Teknik Informatika</option>
                                                <option value="Teknik Sipil">Teknik Sipil</option>
                                                <option value="Digital Arsitektur">Digital Arsitektur</option>
                                                <option value="Manajemen Bisnis">Manajemen Bisnis</option>
                                                <option value="Manajemen Keuangan">Manajemen Keuangan</option>
                                                <option value="Manajemen Perkantoran">Manajemen Perkantoran</option>
                                                <option value="Manajemen Komunikasi">Manajemen Komunikasi</option>
                                                <option value="Multimedia Broadcasting">Multimedia Broadcasting</option>
                                                <option value="Desain Grafis">Desain Grafis</option>
                                            </select>
                                            <div class="invalid-feedback">Silakan pilih program studi terlebih dahulu.</div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="">Foto PAS (3x4)</label>
                                                <input style="padding:3px" type="file" name="foto_ktp" class="form-control" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Angkatan</label>
                                                <input style="padding:3px" type="text" name="angkatan" class="form-control" placeholder="Tahun Bergabung..." required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="alasan">Alasan Ingin Bergabung</label>
                                            <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" class="form-control" id="email" placeholder="Email Aktif Anda..." required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="telepon">Telepon</label>
                                                <input type="text" name="telepon" class="form-control" id="telepon" placeholder="No Telepon Anda..." required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password Anda..." required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="ulangi_password">Ulangi Password</label>
                                                <input type="password" name="password" class="form-control" id="password" placeholder="Ulangi Password Anda..." required>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                                                <label class="form-check-label" for="acceptTerms">
                                                    Saya setuju dengan
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">syarat dan ketentuan</a>
                                                </label>
                                                <div class="invalid-feedback">Anda harus menyetujui sebelum mengirimkan.</div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="termsModalLabel">Syarat dan Ketentuan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Berikut adalah syarat dan ketentuan yang berlaku:</p>
                                                        <ul>
                                                            <li>Pengguna wajib memberikan data yang valid.</li>
                                                            <li>Data yang dikirimkan tidak akan dibagikan tanpa izin.</li>
                                                            <li>Pendaftaran bersifat sukarela namun harus sesuai prosedur.</li>
                                                            <li>Layanan ini dapat berubah sewaktu-waktu tanpa pemberitahuan sebelumnya.</li>
                                                        </ul>
                                                        <p>Dengan mencentang kotak persetujuan, Anda telah membaca dan menerima semua syarat dan ketentuan di atas.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Registrasi
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Sudah punya akun? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>
        // Validasi form menggunakan Bootstrap
        (function() {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>


    <!-- Bootstrap core JavaScript-->
    <script src="assets3/vendor/jquery/jquery.min.js"></script>
    <script src="assets3/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets3/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets3/js/sb-admin-2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>