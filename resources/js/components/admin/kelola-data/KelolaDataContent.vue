<script setup>
import { ref, computed, watch } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import Swal from "sweetalert2";

import ImportModal from "@/components/ui/ImportModal.vue";
import ConfirmDeleteModal from "@/components/ui/ConfirmDeleteModal.vue";
import UpdateAnggotaModal from "@/components/ui/UpdateAnggotaModal.vue";

const page = usePage();
const anggotaList = computed(() => page.props.anggota ?? []);
const currentUser = page.props.currentUser;
const userRole = page.props.currentUser?.role || "user";

const search = ref("");
const statusFilter = ref("");
const jabatanFilter = ref("");
const pageNum = ref(1);
const perPage = 10;
const showImport = ref(false);
const showDelete = ref(false);
const showUpdate = ref(false);
const anggotaToDelete = ref(null);
const anggotaToUpdate = ref(null);

const filteredData = computed(() =>
    anggotaList.value.filter((anggota) => {
        const keyword = search.value.toLowerCase();

        const matchNama = anggota.nama?.toLowerCase().includes(keyword);
        const matchNIM = anggota.nim?.includes(search.value);

        const matchSearch = matchNama || matchNIM;

        const matchStatus =
            !statusFilter.value || anggota.status === statusFilter.value;

        const matchJabatan =
            !jabatanFilter.value ||
            (jabatanFilter.value === null
                ? !anggota.jabatan
                : anggota.jabatan === jabatanFilter.value);

        return matchSearch && matchStatus && matchJabatan;
    })
);

watch([search, statusFilter, jabatanFilter], () => {
    pageNum.value = 1;
});

const totalPages = computed(() =>
    Math.ceil(filteredData.value.length / perPage)
);

const paginatedData = computed(() =>
    filteredData.value.slice(
        (pageNum.value - 1) * perPage,
        pageNum.value * perPage
    )
);

function prevPage() {
    if (pageNum.value > 1) pageNum.value--;
}

function nextPage() {
    if (pageNum.value < totalPages.value) pageNum.value++;
}

function goToPage(p) {
    if (p >= 1 && p <= totalPages.value) pageNum.value = p;
}

function detailAnggota(anggota) {
    router.visit(`/admin/anggota/${anggota.id}`);
}

function confirmDelete(anggota) {
    anggotaToDelete.value = anggota;
    showDelete.value = true;
}

function deleteAnggota() {
    router.delete(route("admin.anggota.destroy", { anggota: anggotaToDelete.value.id }), {
        onSuccess: () => {
            Swal.fire("Dihapus!", "Anggota berhasil dihapus.", "success");
            showDelete.value = false;
            router.reload({ preserveScroll: true });
        },
        onError: () => {
            Swal.fire("Gagal!", "Gagal menghapus anggota.", "error");
        }
    });
}

function showUpdateModal(anggota) {
    anggotaToUpdate.value = { ...anggota };
    showUpdate.value = true;
}

function updateAnggota(updated) {
    const idx = anggotaList.value.findIndex((a) => a.nim === updated.nim);
    if (idx !== -1)
        anggotaList.value[idx] = { ...anggotaList.value[idx], ...updated };
    showUpdate.value = false;
}

function importFile(file) {
    const formData = new FormData();
    formData.append("file", file);

    showImport.value = false;

    setTimeout(() => {
        Swal.fire({
            title: "Import Data?",
            text: "Pastikan file sudah sesuai format yang diminta.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Import!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData();
                formData.append("file", file);

                router.post(route("admin.anggota.import"), formData, {
                    forceFormData: true,
                    onSuccess: () => {
                        Swal.fire({
                            title: "Import Berhasil!",
                            icon: "success",
                            timer: 1500,
                            showConfirmButton: false,
                        });

                        router.reload({ preserveScroll: true });
                    },
                    onError: () => {
                        Swal.fire("Gagal Import", "Pastikan format file benar.", "error");
                    },
                });
            }
        });
    }, 300);
}
</script>

<template>
    <div class="container-fluid">
        <h1 class="h3 mb-3 text-gray-800">Kelola Data Anggota</h1>

        <!-- Tombol Import Modal -->
        <button class="btn btn-warning btn-sm mb-4" @click="showImport = true">
            Import Data Anggota
        </button>
        <ImportModal v-if="showImport" @close="showImport = false" @import="importFile" />

        <div class="d-flex gap-3 mb-3 align-items-end">
            <div>
                <label>Status</label>
                <select class="form-select" v-model="statusFilter">
                    <option value="">Semua</option>
                    <option value="Baru">Baru</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Demisioner">Demisioner</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>
            </div>
            <div>
                <label>Jabatan</label>
                <select class="form-select" v-model="jabatanFilter">
                    <option value="">Semua</option>
                    <option value="-">Tanpa Jabatan</option>
                    <option value="Ketua">Ketua</option>
                    <option value="Sekretaris">Sekretaris</option>
                    <option value="Bendahara">Bendahara</option>
                    <option value="Divisi Humas">Divisi Humas</option>
                    <option value="Divisi Ristek">Divisi Ristek</option>
                    <option value="Divisi Medkom">Divisi Medkom</option>
                    <option value="Divisi Tata Usaha">Divisi Tata Usaha</option>
                    <option value="Divisi Minat dan Bakat">Divisi Minat dan Bakat</option>
                    <option value="Koordinator Angkatan">Koordinator Angkatan</option>
                    <option value="Anggota">Anggota</option>
                </select>
            </div>
            <div>
                <label for="cariNamaAtauNim">Cari Nama atau Nim</label>
                <form class="form-inline my-2 my-lg-0" @submit.prevent>
                    <input class="form-control" id="cariNamaAtauNim" type="search" placeholder="Search"
                        v-model="search" />
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="text-center align-middle">
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Prodi</th>
                                <th>Angkatan</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(anggota, i) in paginatedData" :key="anggota.id">
                                <td class="text-center">
                                    {{ i + 1 + (pageNum - 1) * perPage }}
                                </td>
                                <td class="text-center">{{ anggota.nim }}</td>
                                <td>{{ anggota.nama }}</td>
                                <td>{{ anggota.prodi }}</td>
                                <td class="text-center">
                                    {{ anggota.angkatan }}
                                </td>
                                <td class="text-center">
                                    {{ anggota.jabatan ?? "-" }}
                                </td>
                                <td class="text-center">
                                    <span class="badge" :class="{
                                        'bg-info':
                                            anggota.status === 'Baru',
                                        'bg-success':
                                            anggota.status === 'Aktif',
                                        'bg-secondary':
                                            anggota.status === 'Demisioner',
                                        'bg-danger':
                                            anggota.status === 'Nonaktif',
                                    }">
                                        {{ anggota.status ?? "-" }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-info btn-sm me-1" @click="detailAnggota(anggota)">
                                        Cek
                                    </button>
                                    <button v-if="
                                        (userRole === 'superadmin' &&
                                            anggota.id !==
                                            currentUser.id) ||
                                        (userRole === 'admin' &&
                                            anggota.role === 'user')
                                    " class="btn btn-danger btn-sm me-1" @click="confirmDelete(anggota)">
                                        Hapus
                                    </button>
                                    <button class="btn btn-primary btn-sm" @click="showUpdateModal(anggota)">
                                        Update
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="paginatedData.length === 0">
                                <td colspan="9" class="text-center">
                                    Tidak ada data
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <nav v-if="totalPages > 1" aria-label="...">
                    <ul class="pagination justify-content-left">
                        <li class="page-item" :class="{ disabled: pageNum.value === 1 }">
                            <a class="page-link" href="#" @click.prevent="prevPage">Previous</a>
                        </li>
                        <li class="page-item" v-for="p in totalPages" :key="p" :class="{ active: pageNum.value === p }">
                            <a class="page-link" href="#" @click.prevent="goToPage(p)">{{ p }}</a>
                        </li>
                        <li class="page-item" :class="{ disabled: pageNum.value === totalPages }">
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

<style scoped>
.table-responsive {
    overflow-x: auto;
    min-width: 320px;
}

.table th,
.table td {
    vertical-align: middle !important;
}

.btn+.btn {
    margin-left: 4px;
}

.pagination {
    margin-top: 1rem;
}
</style>
