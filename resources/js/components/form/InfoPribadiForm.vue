<script setup>
defineProps({
    form: Object,
    errors: Object,
});
</script>

<template>
    <!-- Nama -->
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" v-model="form.nama" class="form-control" id="nama" placeholder="Masukkan Nama Lengkap"
            required />
        <div class="invalid-feedback d-block" v-if="form.errors.nama">
            {{ form.errors.nama }}
        </div>
    </div>
    <!-- Tempat & Tanggal Lahir -->
    <div class="form-group row">
        <div class="col-md-6">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" v-model="form.tempat_lahir" class="form-control" id="tempat_lahir" required
                placeholder="Tempat Lahir" />
            <div class="invalid-feedback d-block" v-if="form.errors.tempat_lahir">
                {{ form.errors.tempat_lahir }}
            </div>
        </div>
        <div class="col-md-6">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" v-model="form.tanggal_lahir" class="form-control" id="tanggal_lahir" required />
            <div class="invalid-feedback d-block" v-if="form.errors.tanggal_lahir">
                {{ form.errors.tanggal_lahir }}
            </div>
        </div>
    </div>

    <!-- Jenis Kelamin & Agama -->
    <div class="form-group row">
        <div class="col-md-6">
            <label>Jenis Kelamin</label>
            <div class="form-check">
                <input type="radio" v-model="form.jenis_kelamin" value="L" class="form-check-input" id="laki"
                    required />
                <label for="laki" class="form-check-label">Laki-Laki</label>
            </div>
            <div class="form-check">
                <input type="radio" v-model="form.jenis_kelamin" value="P" class="form-check-input" id="perempuan"
                    required />
                <label for="perempuan" class="form-check-label">Perempuan</label>
            </div>
            <div class="invalid-feedback d-block" v-if="form.errors.jenis_kelamin">
                {{ form.errors.jenis_kelamin }}
            </div>
        </div>

        <div class="col-md-6">
            <label for="agama">Agama</label>
            <select v-model="form.agama" id="agama" class="form-control" required>
                <option value="">Pilih Agama</option>
                <option value="islam">Islam</option>
                <option value="kristen">Kristen</option>
                <option value="katolik">Katolik</option>
                <option value="hindu">Hindu</option>
                <option value="buddha">Buddha</option>
                <option value="konghucu">Konghucu</option>
            </select>
            <div class="invalid-feedback d-block" v-if="form.errors.agama">
                {{ form.errors.agama }}
            </div>
        </div>
    </div>

    <!-- Alamat -->
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea v-model="form.alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat Asal Kamu"
            required></textarea>
        <div class="invalid-feedback d-block" v-if="form.errors.alamat">
            {{ form.errors.alamat }}
        </div>
    </div>

    <!-- NIM -->
    <div class="form-group">
        <label for="nim">NIM</label>
        <input type="number" v-model="form.nim" class="form-control" id="nim" placeholder="Masukkan NIM Kamu" />
    </div>

    <!-- Prodi -->
    <div class="form-group">
        <label for="prodi">Asal Prodi</label>
        <select v-model="form.prodi" id="prodi" class="form-control" required>
            <option value="" disabled selected hidden>
                Pilih Prodi atau Jurusan Kuliah Kamu
            </option>
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Teknik Sipil">Teknik Sipil</option>
            <option value="Digital Arsitektur">Digital Arsitektur</option>
            <option value="Manajemen Bisnis">Manajemen Bisnis</option>
            <option value="Manajemen Keuangan">Manajemen Keuangan</option>
            <option value="Manajemen Perkantoran">Manajemen Perkantoran</option>
            <option value="Manajemen Komunikasi">Manajemen Komunikasi</option>
            <option value="Multimedia Broadcasting">
                Multimedia Broadcasting
            </option>
            <option value="Desain Grafis">Desain Grafis</option>
        </select>
        <div class="invalid-feedback d-block" v-if="form.errors.prodi">
            {{ form.errors.prodi }}
        </div>
    </div>
</template>
