<script setup>
import { ref, computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import { route } from "ziggy-js";

const page = usePage();
const anggotaList = ref(page.props.anggota ?? []);

const pageNum = ref(1);
const perPage = 10;

const totalPages = computed(() =>
    Math.ceil(anggotaList.value.length / perPage)
);

const paginatedData = computed(() =>
    anggotaList.value.slice(
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

function downloadPdf() {
    window.open(route("anggota.cetak-pdf"), "_blank");
}

function cetakAnggotaBaru() {
    window.open(route("anggota.cetakBaru"), "_blank");
}

function cetak(anggota) {
    window.open(route("anggota.cetak-data-diri", { id: anggota.id }), "_blank");
}
</script>

<template>
    <div class="container-fluid">
        <h1 class="h3 mb-3 text-gray-800">Data Anggota</h1>
        <button class="btn btn-warning btn-sm mb-3" @click="downloadPdf">
            Cetak Data
        </button>
        <button
            class="btn btn-primary btn-sm mb-3 ms-2"
            @click="cetakAnggotaBaru"
        >
            Cetak Anggota Baru
        </button>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
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
                            <tr
                                v-for="(anggota, i) in paginatedData"
                                :key="anggota.nim"
                            >
                                <td class="text-center">
                                    {{ i + 1 + (pageNum - 1) * perPage }}
                                </td>
                                <td class="text-center">{{ anggota.nim }}</td>
                                <td>{{ anggota.nama }}</td>
                                <td>{{ anggota.member_registration.alamat }}</td>
                                <td>{{ anggota.prodi }}</td>
                                <td class="text-center">
                                    {{ anggota.angkatan }}
                                </td>
                                <td class="text-center">
                                    {{ anggota.jabatan || "-" }}
                                </td>
                                <td class="text-center">
                                    <span
                                        class="badge"
                                        :class="{
                                            'bg-info':
                                                anggota.status === 'Baru',
                                            'bg-success':
                                                anggota.status === 'Aktif',
                                            'bg-secondary':
                                                anggota.status === 'Demisioner',
                                            'bg-danger':
                                                anggota.status === 'Nonaktif',
                                        }"
                                    >
                                        {{ anggota.status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button
                                        class="btn btn-warning btn-sm"
                                        @click="cetak(anggota)"
                                    >
                                        Cetak
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
                <nav aria-label="...">
                    <ul class="pagination">
                        <li
                            class="page-item"
                            :class="{ disabled: pageNum === 1 }"
                        >
                            <a
                                class="page-link"
                                href="#"
                                @click.prevent="prevPage"
                                >Previous</a
                            >
                        </li>
                        <li
                            class="page-item"
                            v-for="p in totalPages"
                            :key="p"
                            :class="{ active: pageNum === p }"
                        >
                            <a
                                class="page-link"
                                href="#"
                                @click.prevent="goToPage(p)"
                                >{{ p }}</a
                            >
                        </li>
                        <li
                            class="page-item"
                            :class="{ disabled: pageNum === totalPages }"
                        >
                            <a
                                class="page-link"
                                href="#"
                                @click.prevent="nextPage"
                                >Next</a
                            >
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>
