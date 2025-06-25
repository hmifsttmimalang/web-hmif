<script setup>
import { ref, computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const page = usePage();
const userBaruList = computed(() => page.props.userBaruList ?? []);

const pageNum = ref(1);
const perPage = 10;

const totalPages = computed(() =>
    Math.ceil(userBaruList.value.length / perPage)
);
const paginatedData = computed(() =>
    userBaruList.value.slice(
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
</script>

<template>
    <div class="container-fluid">
        <h1 class="h3 mb-3 text-gray-800">Info Anggota Baru</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive mb-3">
                    <table class="table table-bordered table-hover">
                        <thead class="text-center align-middle">
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Prodi</th>
                                <th>Angkatan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(user, i) in paginatedData" :key="user.nim">
                                <td class="text-center">
                                    {{ i + 1 + (pageNum - 1) * perPage }}
                                </td>
                                <td class="text-center">{{ user.nim }}</td>
                                <td>{{ user.nama }}</td>
                                <td>{{ user.member_registration.alamat }}</td>
                                <td>{{ user.prodi }}</td>
                                <td class="text-center">{{ user.angkatan }}</td>
                                <td class="text-center">
                                    <span class="badge bg-info">{{
                                        user.status
                                    }}</span>
                                </td>
                                <td class="text-center">
                                    <Link
                                        :href="`/admin/anggota/${user.id}`"
                                        class="btn btn-info btn-sm ms-2"
                                        >Cek</Link
                                    >
                                </td>
                            </tr>
                            <tr v-if="paginatedData.length === 0">
                                <td colspan="10" class="text-center">
                                    Tidak ada data
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <nav v-if="totalPages > 1" aria-label="...">
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
