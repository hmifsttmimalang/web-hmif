<template>
    <div class="container-fluid">
        <h1 class="h3 mb-3 text-gray-800">Data Anggota</h1>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                    <thead class="text-center align-middle">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Prodi</th>
                            <th>Angkatan</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(anggota, i) in paginatedData" :key="anggota.nim">
                            <td class="text-center">{{ i + 1 + (page - 1) * perPage }}</td>
                            <td class="text-center">{{ anggota.nim }}</td>
                            <td>{{ anggota.nama }}</td>
                            <td>{{ anggota.alamat }}</td>
                            <td>{{ anggota.prodi }}</td>
                            <td class="text-center">{{ anggota.angkatan }}</td>
                            <td class="text-center">{{ anggota.jabatan || '-' }}</td>
                            <td class="text-center">
                                <span class="badge" :class="{
                                    'bg-success': anggota.status === 'Aktif',
                                    'bg-info': anggota.status === 'Demisioner',
                                    'bg-danger': anggota.status === 'Nonaktif'
                                }">
                                    {{ anggota.status }}
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" @click="cetak(anggota)">Cetak</button>
                            </td>
                        </tr>
                        <tr v-if="paginatedData.length === 0">
                            <td colspan="9" class="text-center">Tidak ada data</td>
                        </tr>
                    </tbody>
                </table>
                <!-- Pagination -->
                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item" :class="{ disabled: page === 1 }">
                            <a class="page-link" href="#" @click.prevent="prevPage">Previous</a>
                        </li>
                        <li class="page-item" v-for="p in totalPages" :key="p" :class="{ active: page === p }">
                            <a class="page-link" href="#" @click.prevent="goToPage(p)">{{ p }}</a>
                        </li>
                        <li class="page-item" :class="{ disabled: page === totalPages }">
                            <a class="page-link" href="#" @click.prevent="nextPage">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from "vue"

// Data dummy, nanti tinggal fetch dari API/Backend
const anggotaList = ref([
    { nim: "423025", nama: "Adi Chandra", alamat: "Jl. Dieng Atas", prodi: "Teknik Informatika", angkatan: "2023", jabatan: "", status: "Aktif" },
    { nim: "423026", nama: "Ardiansyah", alamat: "Jl. Candi Panggung", prodi: "Teknik Informatika", angkatan: "2023", jabatan: "", status: "Demisioner" },
    { nim: "423027", nama: "Aventus Akong", alamat: "Jl. Candi Panggung Atas", prodi: "Teknik Informatika", angkatan: "2023", jabatan: "", status: "Nonaktif" },
    // Tambah data lain kalau mau
])

const page = ref(1)
const perPage = 10

const totalPages = computed(() =>
    Math.ceil(anggotaList.value.length / perPage)
)
const paginatedData = computed(() =>
    anggotaList.value.slice((page.value - 1) * perPage, page.value * perPage)
)

function prevPage() {
    if (page.value > 1) page.value--
}
function nextPage() {
    if (page.value < totalPages.value) page.value++
}
function goToPage(p) {
    if (p >= 1 && p <= totalPages.value) page.value = p
}

// Fungsi cetak (dummy)
function cetak(anggota) {
    alert("Cetak kartu untuk: " + anggota.nama)
}
</script>
