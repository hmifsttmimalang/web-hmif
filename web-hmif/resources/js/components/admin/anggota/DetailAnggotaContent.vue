<script setup>
import { usePage, Link } from "@inertiajs/vue3";

// Anggota diambil dari props (Inertia), bukan dummy lokal
const page = usePage();
const anggota = page.props.anggota; // Pastikan controller kirim 'anggota'
</script>

<template>
  <div class="container-fluid" v-if="anggota">
    <h1 class="h3 mb-4 text-gray-800">Detail Anggota</h1>
    <div class="row">
      <!-- Data Diri -->
      <div class="col-md-6">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><b>DATA DIRI</b></h6>
          </div>
          <div class="card-body mt-3">
            <div class="col-auto text-center">
              <img
                :src="anggota.foto ? '/storage/' + anggota.foto : '/assets2/img/messages-3.jpg'"
                alt="fotoprofil"
                class="img-fluid rounded-circle"
                style="width: 200px"
              />
            </div>
            <br />
            <h5 class="text-center card-title"><b>{{ anggota.nama }}</b></h5>
            <ul class="list-group">
              <li class="list-group-item">
                <h6 class="mb-1 font-bold">Tempat, Tanggal Lahir</h6>
                <h6 class="mb-0">{{ anggota.tempat_lahir }}, {{ anggota.tanggal_lahir }}</h6>
              </li>
              <li class="list-group-item">
                <h6 class="mb-1 font-bold">Jenis Kelamin</h6>
                <h6 class="mb-0">
                  {{ anggota.jenis_kelamin === 'L' ? 'Pria' : 'Perempuan' }}
                </h6>
              </li>
              <li class="list-group-item">
                <h6 class="mb-1 font-bold">Agama</h6>
                <h6 class="mb-0">{{ anggota.agama }}</h6>
              </li>
              <li class="list-group-item">
                <h6 class="mb-1 font-bold">Alamat</h6>
                <h6 class="mb-0">{{ anggota.alamat }}</h6>
              </li>
              <li class="list-group-item">
                <h6 class="mb-1 font-bold">Email</h6>
                <h6 class="mb-0">{{ anggota.email }}</h6>
              </li>
              <li class="list-group-item">
                <h6 class="mb-1 font-bold">Telepon</h6>
                <h6 class="mb-0">{{ anggota.telepon }}</h6>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Informasi Anggota -->
      <div class="col-md-6">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><b>INFORMASI ANGGOTA</b></h6>
          </div>
          <div class="card-body mt-1">
            <ul class="list-group">
              <li class="list-group-item">
                <h6 class="mb-1 font-bold">Angkatan</h6>
                <h6 class="mb-0">{{ anggota.angkatan }}</h6>
              </li>
              <li class="list-group-item">
                <h6 class="mb-1 font-bold">Alasan Bergabung</h6>
                <h6 class="mb-0">{{ anggota.alasan }}</h6>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex ms-3 mt-3">
      <Link class="btn btn-secondary" href="/admin/kelola-data">Kembali</Link>
    </div>
  </div>
  <div v-else>
    <div class="d-flex ms-3 mt-3">
      <Link class="btn btn-secondary" href="/admin/kelola-data">Kembali</Link>
    </div>
    <div class="alert alert-warning text-center mt-5">
      Data anggota tidak ditemukan.
    </div>
  </div>
</template>

<style scoped>
.font-bold {
  font-weight: bold;
}
</style>
