<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();
const pendaftarBaru = computed(() => page.props.pendaftarBaru || []);
const totalPendaftar = computed(() => page.props.totalPendaftar || 0);
const totalAnggota = computed(() => page.props.totalAnggota || 0);
</script>

<template>
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div
                                    class="h3 font-weight-bold text-info text-uppercase mb-1"
                                >
                                    Pendaftar Masuk
                                </div>
                                <div class="h5 mt-3 font-weight-bold">
                                    {{ totalPendaftar }} Orang
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div
                                                class="progress-bar bg-info"
                                                role="progressbar"
                                                style="width: 100%"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i
                                    class="fas fa-user fa-2x text-gray-300"
                                    style="font-size: 90px"
                                ></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div
                                    class="h3 font-weight-bold text-success text-uppercase mb-1"
                                >
                                    Total Anggota
                                </div>
                                <div class="h5 mt-3 font-weight-bold">
                                    {{ totalAnggota }} Orang
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div
                                                class="progress-bar bg-success"
                                                role="progressbar"
                                                style="width: 100%"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i
                                    class="fas fa-user fa-2x text-gray-300"
                                    style="font-size: 90px"
                                ></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mt-3" />
        <h2 class="text-gray-800">Data Pendaftar Baru</h2>
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
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(p, i) in pendaftarBaru.data || []"
                            :key="p.nim"
                        >
                            <td class="text-center">
                                {{
                                    i +
                                    1 +
                                    (pendaftarBaru.current_page - 1) *
                                        pendaftarBaru.per_page
                                }}
                            </td>
                            <td class="text-center">{{ p.nim }}</td>
                            <td>{{ p.nama }}</td>
                            <td>{{ p.member_registration.alamat }}</td>
                            <td>{{ p.prodi }}</td>
                            <td class="text-center">{{ p.angkatan }}</td>
                            <td class="text-center">
                                <span class="badge badge-info">{{
                                    p.status
                                }}</span>
                            </td>
                        </tr>
                        <tr
                            v-if="
                                !pendaftarBaru.data ||
                                pendaftarBaru.data.length === 0
                            "
                        >
                            <td colspan="7" class="text-center">
                                Tidak ada data
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <nav v-if="pendaftarBaru.last_page > 1">
                <ul class="pagination">
                    <li
                        class="page-item"
                        :class="{ disabled: pendaftarBaru.current_page === 1 }"
                    >
                        <a
                            class="page-link"
                            href="#"
                            @click.prevent="
                                $inertia.get(route('admin.dashboard'), {
                                    page: pendaftarBaru.current_page - 1,
                                })
                            "
                            >Previous</a
                        >
                    </li>
                    <li
                        v-for="p in pendaftarBaru.last_page"
                        :key="p"
                        class="page-item"
                        :class="{ active: pendaftarBaru.current_page === p }"
                    >
                        <a
                            class="page-link"
                            href="#"
                            @click.prevent="
                                $inertia.get(route('admin.dashboard'), {
                                    page: p,
                                })
                            "
                            >{{ p }}</a
                        >
                    </li>
                    <li
                        class="page-item"
                        :class="{
                            disabled:
                                pendaftarBaru.current_page ===
                                pendaftarBaru.last_page,
                        }"
                    >
                        <a
                            class="page-link"
                            href="#"
                            @click.prevent="
                                $inertia.get(route('admin.dashboard'), {
                                    page: pendaftarBaru.current_page + 1,
                                })
                            "
                            >Next</a
                        >
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>
