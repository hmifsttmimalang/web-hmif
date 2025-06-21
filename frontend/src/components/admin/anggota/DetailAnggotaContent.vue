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
              <img :src="anggota.foto || '/assets2/img/messages-3.jpg'" alt="fotoprofil"
                class="img-fluid rounded-circle" style="width: 200px" />
            </div>
            <br>
            <h5 class="text-center card-title"><b>{{ anggota.nama }}</b></h5>
            <ul class="list-group">
              <li class="list-group-item">
                <h6 class="mb-1 font-bold">Tempat, Tanggal Lahir</h6>
                <h6 class="mb-0">{{ anggota.tempat_lahir }}, {{ anggota.tanggal_lahir }}</h6>
              </li>
              <li class="list-group-item">
                <h6 class="mb-1 font-bold">Jenis Kelamin</h6>
                <h6 class="mb-0">{{ anggota.jenis_kelamin === 'L' ? 'Pria' : 'Perempuan' }}</h6>
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
      <!-- Data Nilai Peserta -->
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
              <!-- Tambah data lain kalau perlu -->
            </ul>
            <!-- <button class="btn btn-primary mt-3 btn-block" @click="validasi(anggota)">Validasi Data Peserta</button> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <div v-else>
    <div class="alert alert-warning text-center mt-5">
      Data anggota tidak ditemukan.
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const anggota = ref(null)

// Dummy data; ganti ke axios kalau sudah backend
const dummyList = [
  {
    id: 1,
    nama: "Adi Chandra",
    nim: "423025",
    alamat: "Jl. Dieng Atas",
    prodi: "Teknik Informatika",
    angkatan: "2023",
    jabatan: "",
    status: "Aktif",
    foto: "/assets2/img/messages-3.jpg",
    tempat_lahir: "Malang",
    tanggal_lahir: "13 September 2004",
    jenis_kelamin: "L",
    agama: "Islam",
    email: "adi99@gmail.com",
    telepon: "082236541717",
    alasan: "Karena ingin join"
  },
    {
        id: 2,
        nama: "Ardiansyah",
        nim: "423026",
        alamat: "Jl. Candi Panggung",
        prodi: "Teknik Informatika",
        angkatan: "2023",
        jabatan: "",
        status: "Demisioner",
        foto: "/assets2/img/messages-3.jpg",
        tempat_lahir: "Surabaya",
        tanggal_lahir: "15 Agustus 2004",
        jenis_kelamin: "L",
        agama: "Islam",
        email: "ardi.pulaem069@gmail.com",
        telepon: "082236541718",
        alasan: "Karena ingin join"
    },
    {
        id: 3,
        nama: "Aventus Akong",
        nim: "423027",
        alamat: "Jl. Candi Panggung Barat",
        prodi: "Teknik Informatika",
        angkatan: "2023",
        jabatan: "",
        status: "Nonaktif",
        foto: "/assets2/img/messages-3.jpg",
        tempat_lahir: "Manggarai",
        tanggal_lahir: "21 Desember 2004",
        jenis_kelamin: "L",
        agama: "Katolik",
        email: "efenpentus@gmail.com",
        telepon: "082236541719",
        alasan: "Karena ingin join"
    },
]

onMounted(() => {
  const id = route.params.id
  anggota.value = dummyList.find(a => a.id === parseInt(id)) || null
})
</script>

<style scoped>
.font-bold {
  font-weight: bold;
}
/* Custom style bisa tambahin di sini */
</style>
