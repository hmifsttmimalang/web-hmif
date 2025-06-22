<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()
const pendaftarBaru = computed(() => page.props.pendaftarBaru || [])
const totalPendaftar = computed(() => page.props.totalPendaftar || 0)
const totalAnggota = computed(() => page.props.totalAnggota || 0)
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
                                <div class="h3 font-weight-bold text-info text-uppercase mb-1">
                                    Pendaftar Masuk
                                </div>
                                <div class="h5 mt-3 font-weight-bold">{{ totalPendaftar }} Orang</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 100%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300" style="font-size: 90px;"></i>
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
                                <div class="h3 font-weight-bold text-success text-uppercase mb-1">
                                    Total Anggota
                                </div>
                                <div class="h5 mt-3 font-weight-bold">{{ totalAnggota }} Orang</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300" style="font-size: 90px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mt-3">
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
                        <tr v-for="(p, i) in pendaftarBaru" :key="p.nim">
                            <td class="text-center align-middle">{{ i + 1 }}</td>
                            <td class="text-center align-middle">{{ p.nim }}</td>
                            <td>{{ p.nama }}</td>
                            <td>{{ p.alamat }}</td>
                            <td class="text-center align-middle">{{ p.prodi }}</td>
                            <td class="text-center align-middle">{{ p.angkatan }}</td>
                            <td class="text-center align-middle"><span class="badge badge-info">Baru</span></td>
                        </tr>
                        <tr v-if="pendaftarBaru.length === 0">
                            <td colspan="7" class="text-center">Tidak ada data</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
