<script setup>
import { ref } from "vue"
import { Link } from "@inertiajs/vue3"

const userBaruList = ref([
    {
        id: 1,
        nim: "423025",
        nama: "Adi Chandra",
        alamat: "Jl. Dieng Atas",
        prodi: "Teknik Informatika",
        angkatan: "2023",
        telepon: "08999999",
        email: "user@gmail.com",
        status: "Baru"
    },
    {
        id: 2,
        nim: "423026",
        nama: "Ardiansyah",
        alamat: "Jl. Candi Panggung",
        prodi: "Teknik Informatika",
        angkatan: "2023",
        telepon: "08999999",
        email: "user@gmail.com",
        status: "Baru"
    },
    {
        id: 3,
        nim: "423027",
        nama: "Aventus Akong",
        alamat: "Jl. Candi Panggung Atas",
        prodi: "Teknik Informatika",
        angkatan: "2023",
        telepon: "08999999",
        email: "user@gmail.com",
        status: "Baru"
    },
])
</script>

<template>
    <div class="container-fluid">
        <h1 class="h3 mb-3 text-gray-800">Info Anggota Baru</h1>
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
                            <th>No. Telepon</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(user, i) in userBaruList" :key="user.nim">
                            <td class="text-center">{{ i + 1 }}</td>
                            <td class="text-center">{{ user.nim }}</td>
                            <td>{{ user.nama }}</td>
                            <td>{{ user.alamat }}</td>
                            <td>{{ user.prodi }}</td>
                            <td class="text-center">{{ user.angkatan }}</td>
                            <td class="text-center">{{ user.telepon }}</td>
                            <td class="text-center">{{ user.email }}</td>
                            <td class="text-center">
                                <span class="badge bg-info">{{ user.status }}</span>
                            </td>
                            <td class="text-center">
                                <Link :href="`/admin/anggota/${user.id}`" class="btn btn-info btn-sm ms-2">Cek</Link>
                            </td>
                        </tr>
                        <tr v-if="userBaruList.length === 0">
                            <td colspan="10" class="text-center">Tidak ada data</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
 