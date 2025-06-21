<template>
    <!-- page title -->
    <div class="pagetitle">
        <h1>Edit Profil</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Edit Profil Peserta</li>
            </ol>
        </nav>
    </div>

    <!-- Content -->
    <div class="row">
        <div class="col-md-8">
            <form class="user">
                <div class="form-group mb-3">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama"
                        placeholder="Masukkan Nama Lengkap Anda...">
                </div>

                <div class="form-group row mb-3">
                    <div class="col-md-6">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir"
                            placeholder="Tempat Lahir Anda...">
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                            placeholder="Tanggal Lahir Anda...">
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <div class="col-md-6">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <div class="form-check">
                            <input type="radio" name="jenis_kelamin" value="L" class="form-check-input" id="laki">
                            <label for="laki" class="form-check-label">Laki-Laki</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="jenis_kelamin" value="P" class="form-check-input" id="perempuan">
                            <label for="perempuan" class="form-check-label">Perempuan</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="agama">Agama</label>
                        <select name="agama" id="agama" class="form-control">
                            <option value="">Pilih Agama</option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="katolik">Katolik</option>
                            <option value="hindu">Hindu</option>
                            <option value="buddha">Buddha</option>
                            <option value="konghucu">Konghucu</option>
                        </select>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control"></textarea>
                </div>

                <div class="form-group row mb-3">
                    <div class="col-md-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Email Aktif Anda...">
                    </div>
                    <div class="col-md-6">
                        <label for="telepon">Telepon</label>
                        <input type="text" name="telepon" class="form-control" id="telepon"
                            placeholder="No Telepon Anda...">
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <div class="col-md-6">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Masukkan Password Anda...">
                    </div>
                    <div class="col-md-6">
                        <label for="konfirmasi_password">Ulangi Password</label>
                        <input type="password" name="password" class="form-control" id="konfirmasi_password"
                            placeholder="Ulangi Password Anda...">
                    </div>
                </div>

                <button type="submit" name="simpan" class="btn btn-primary mb-5">Ubah</button>
                <router-link to="/dashboard" class="btn btn-secondary mb-5">Kembali</router-link>
            </form>
        </div>
        <div class="col-md-4">
            <img src="/assets2/img/profile-img.jpg" alt="foto profil" class="img-fluid">
            <input type="file" name="gambar" class="form-control mt-2">
        </div>
    </div>

</template>