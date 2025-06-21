<template>
    <div class="container-fluid">
        <!-- Judul -->
        <h1 class="h3 mb-3 text-gray-800">Kelola Data Anggota</h1>

        <!-- Tombol Import Modal -->
        <button class="btn btn-warning btn-sm mb-3" @click="showImport = true">
            Import Data Anggota
        </button>

        <!-- Modal Import Data -->
        <ImportModal v-if="showImport" @close="showImport = false" @import="importFile" />

        <!-- Search Bar -->
        <div class="d-flex justify-content-between">
            <div></div>
            <form class="form-inline my-2 my-lg-0" @submit.prevent>
                <input class="form-control mr-sm-2 mb-4" type="search" placeholder="Search" v-model="search">
            </form>
        </div>

        <!-- Tabel Data -->
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
                                }">{{ anggota.status }}</span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-info btn-sm" @click="detailAnggota(anggota)">Cek</button>
                                <button class="btn btn-danger btn-sm" @click="confirmDelete(anggota)">Hapus</button>
                                <button class="btn btn-primary btn-sm" @click="showUpdateModal(anggota)">Update</button>
                            </td>
                        </tr>
                        <tr v-if="paginatedData.length === 0">
                            <td colspan="9" class="text-center">Tidak ada data</td>
                        </tr>
                    </tbody>
                </table>
                <!-- Pagination -->
                <nav v-if="totalPages > 1" aria-label="...">
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

        <!-- Modal Konfirmasi Hapus -->
        <ConfirmDeleteModal v-if="showDelete" :anggota="anggotaToDelete" @close="showDelete = false"
            @confirm="deleteAnggota" />

        <!-- Modal Update Anggota -->
        <UpdateAnggotaModal v-if="showUpdate" :anggota="anggotaToUpdate" @close="showUpdate = false"
            @save="updateAnggota" />
    </div>
</template>

<script setup>
import { ref, computed } from "vue";
import { useRouter } from "vue-router";
import ImportModal from "@/components/admin/ui/ImportModal.vue";
import ConfirmDeleteModal from "@/components/admin/ui/ConfirmDeleteModal.vue";
import UpdateAnggotaModal from "@/components/admin/ui/UpdateAnggotaModal.vue";

const router = useRouter();

const anggotaList = ref([
    { id: 1, nim: "423025", nama: "Adi Chandra", alamat: "Jl. Dieng Atas", prodi: "Teknik Informatika", angkatan: "2023", jabatan: "", status: "Aktif" },
    { id: 2, nim: "423026", nama: "Ardiansyah", alamat: "Jl. Candi Panggung", prodi: "Teknik Informatika", angkatan: "2023", jabatan: "", status: "Demisioner" },
    { id: 3, nim: "423027", nama: "Aventus Akong", alamat: "Jl. Candi Panggung Atas", prodi: "Teknik Informatika", angkatan: "2023", jabatan: "", status: "Nonaktif" },
])

const search = ref("")
const page = ref(1)
const perPage = 10
const showImport = ref(false)
const showDelete = ref(false)
const showUpdate = ref(false)
const anggotaToDelete = ref(null)
const anggotaToUpdate = ref(null)

const filteredData = computed(() =>
    anggotaList.value.filter(anggota =>
        anggota.nama.toLowerCase().includes(search.value.toLowerCase()) ||
        anggota.nim.includes(search.value)
    )
)

const totalPages = computed(() =>
    Math.ceil(filteredData.value.length / perPage)
)

const paginatedData = computed(() =>
    filteredData.value.slice((page.value - 1) * perPage, page.value * perPage)
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

function detailAnggota(anggota) {
    router.push(`/admin/anggota/${anggota.id}`)
    alert("Detail anggota: " + anggota.nama)
}
function confirmDelete(anggota) {
    anggotaToDelete.value = anggota
    showDelete.value = true
}
function deleteAnggota() {
    // Hapus anggota dari list, atau kirim request ke backend
    anggotaList.value = anggotaList.value.filter(a => a.nim !== anggotaToDelete.value.nim)
    showDelete.value = false
}
function showUpdateModal(anggota) {
    anggotaToUpdate.value = { ...anggota } // copy data
    showUpdate.value = true
}
function updateAnggota(updated) {
    // Update data anggota, atau patch ke backend
    const idx = anggotaList.value.findIndex(a => a.nim === updated.nim)
    if (idx !== -1) anggotaList.value[idx] = { ...anggotaList.value[idx], ...updated }
    showUpdate.value = false
}
function importFile(file) {
    // Kirim file ke backend, parse di server
    alert("File import: " + file.name)
    showImport.value = false
}
</script>
