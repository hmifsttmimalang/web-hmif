<script setup>
import { computed } from "vue";
import { usePage, Link } from "@inertiajs/vue3";
import dayjs from "dayjs";
import localizedFormat from "dayjs/plugin/localizedFormat";
import "dayjs/locale/id";
import capitalize from "@/utils/capitalize.js";

const page = usePage();
const anggota = page.props.anggota;

dayjs.extend(localizedFormat);
dayjs.locale("id");

function formatTelepon(waLink) {
    if (!waLink) return "-";

    const match = waLink.match(/^https:\/\/wa\.me\/(\d+)/);
    if (!match) return waLink;

    let nomor = match[1];
    if (nomor.startsWith("62")) {
        return "0" + nomor.slice(2);
    }

    return nomor;
}

const minatList = computed(() => {
    const raw = anggota.member_registration.minat;

    if (Array.isArray(raw)) return raw;

    if (!raw) return [];

    try {
        const parsed = JSON.parse(raw);
        return Array.isArray(parsed) ? parsed : [];
    } catch (e) {
        return [];
    }
});

function formatTanggal(tgl) {
    if (!tgl) return "-";
    return dayjs(tgl).format("LL");
}
</script>

<template>
    <div class="container-fluid" v-if="anggota">
        <Link class="btn btn-secondary mb-3" href="/admin/kelola-data">Kembali</Link>
        <hr class="border-secondary" />
        <h1 class="h3 mb-3 text-gray-800">Detail Anggota</h1>
        <div class="d-flex justify-content-start mb-3"></div>
        <div class="row">
            <!-- Data Diri -->
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <b>DATA DIRI</b>
                        </h6>
                    </div>
                    <div class="card-body mt-3">
                        <div class="col-auto text-center">
                            <img :src="anggota.foto ? '/storage/' + anggota.foto : '/assets2/img/messages-3.jpg'"
                                alt="fotoprofil" class="img-fluid rounded-circle"
                                style="width: 200px; height: 200px; object-fit: cover" />
                        </div>
                        <br />
                        <h5 class="text-center card-title">
                            <b>{{ anggota.nama }}</b>
                        </h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <h6 class="mb-1 font-bold">
                                    Tempat, Tanggal Lahir
                                </h6>
                                <h6 class="mb-0">
                                    {{
                                        anggota.member_registration
                                            .tempat_lahir
                                    }},
                                    {{
                                        formatTanggal(
                                            anggota.member_registration
                                                .tanggal_lahir
                                        )
                                    }}
                                </h6>
                            </li>
                            <li class="list-group-item">
                                <h6 class="mb-1 font-bold">Jenis Kelamin</h6>
                                <h6 class="mb-0">
                                    {{
                                        anggota.member_registration
                                            .jenis_kelamin === "L"
                                            ? "Pria"
                                            : anggota.member_registration
                                                .jenis_kelamin === "P"
                                                ? "Perempuan"
                                                : "-"
                                    }}
                                </h6>
                            </li>
                            <li class="list-group-item">
                                <h6 class="mb-1 font-bold">Agama</h6>
                                <h6 class="mb-0">
                                    {{
                                        capitalize(
                                            anggota.member_registration.agama
                                        )
                                    }}
                                </h6>
                            </li>
                            <li class="list-group-item">
                                <h6 class="mb-1 font-bold">Alamat</h6>
                                <h6 class="mb-0">
                                    {{ anggota.member_registration.alamat }}
                                </h6>
                            </li>
                            <li class="list-group-item">
                                <h6 class="mb-1 font-bold">Email</h6>
                                <h6 class="mb-0">{{ anggota.email }}</h6>
                            </li>
                            <li class="list-group-item">
                                <h6 class="mb-1 font-bold">Telepon</h6>
                                <h6 class="mb-0">
                                    {{ formatTelepon(anggota.telepon) }}
                                </h6>
                            </li>
                            <li class="list-group-item">
                                <h6 class="mb-1 font-bold">Link Nomor WhatsApp</h6>
                                <a :href="anggota.telepon" target="_blank">
                                    {{ formatTelepon(anggota.telepon) }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Informasi Anggota -->
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <b>INFORMASI ANGGOTA</b>
                        </h6>
                    </div>
                    <div class="card-body mt-1">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <h6 class="mb-1 font-bold">NIM</h6>
                                <h6 class="mb-0">{{ anggota.nim }}</h6>
                            </li>
                            <li class="list-group-item">
                                <h6 class="mb-1 font-bold">Prodi</h6>
                                <h6 class="mb-0">{{ anggota.prodi }}</h6>
                            </li>
                            <li class="list-group-item">
                                <h6 class="mb-1 font-bold">Angkatan</h6>
                                <h6 class="mb-0">{{ anggota.angkatan }}</h6>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <template v-if="anggota.status === 'Baru' && anggota.member_registration">
                <!-- Pertanyaan Daftar -->
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <b>PERTANYAAN PENDAFTARAN</b>
                            </h6>
                        </div>
                        <div class="card-body mt-1">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h6 class="mb-1 font-bold">
                                        Motivasi Bergabung
                                    </h6>
                                    <h6 class="mb-0">
                                        {{
                                            anggota.member_registration
                                                .motivasi || "-"
                                        }}
                                    </h6>
                                </li>
                                <li class="list-group-item">
                                    <h6 class="mb-1 font-bold">
                                        Harapan dari Organisasi
                                    </h6>
                                    <h6 class="mb-0">
                                        {{
                                            anggota.member_registration
                                                .harapan || "-"
                                        }}
                                    </h6>
                                </li>
                                <li class="list-group-item">
                                    <h6 class="mb-1 font-bold">
                                        Cara Membagi Waktu
                                    </h6>
                                    <h6 class="mb-0">
                                        {{
                                            anggota.member_registration
                                                .bagi_waktu || "-"
                                        }}
                                    </h6>
                                </li>
                                <li class="list-group-item">
                                    <h6 class="mb-1 font-bold">
                                        Bersedia Berkontribusi?
                                    </h6>
                                    <h6 class="mb-0">
                                        {{
                                            anggota.member_registration
                                                .kontribusi || "-"
                                        }}
                                    </h6>
                                </li>
                                <!-- Minat dan Bakat -->
                                <li class="list-group-item">
                                    <h6 class="mb-1 font-bold">
                                        Minat dan Bakat
                                    </h6>
                                    <h6 class="mb-0">
                                        {{ minatList.join(", ") || "-" }}
                                        <template v-if="
                                            anggota.member_registration
                                                .minat_lainnya
                                        ">
                                            ({{
                                                anggota.member_registration
                                                    .minat_lainnya
                                            }})
                                        </template>
                                    </h6>
                                </li>

                                <li class="list-group-item">
                                    <h6 class="mb-1 font-bold">
                                        Pengalaman Organisasi
                                    </h6>
                                    <h6 class="mb-0">
                                        {{
                                            anggota.member_registration
                                                .pengalaman_organisasi || "-"
                                        }}
                                    </h6>
                                </li>

                                <li class="list-group-item">
                                    <h6 class="mb-1 font-bold">
                                        Divisi yang Diminati
                                    </h6>
                                    <h6 class="mb-0">
                                        {{
                                            anggota.member_registration
                                                .divisi || "-"
                                        }}
                                    </h6>
                                </li>

                                <!-- Portofolio -->
                                <li class="list-group-item" v-if="
                                    anggota.member_registration
                                        .ket_portofolio
                                ">
                                    <h6 class="mb-1 font-bold">
                                        Penjelasan Portofolio
                                    </h6>
                                    <h6 class="mb-0">
                                        {{
                                            anggota.member_registration
                                                .ket_portofolio
                                        }}
                                    </h6>
                                </li>

                                <li class="list-group-item" v-if="
                                    anggota.member_registration
                                        .link_portofolio
                                ">
                                    <h6 class="mb-1 font-bold">
                                        Link Portofolio
                                    </h6>
                                    <h6 class="mb-0">
                                        <a :href="anggota.member_registration
                                                .link_portofolio
                                            " target="_blank">
                                            {{
                                                anggota.member_registration
                                                    .link_portofolio
                                            }}
                                        </a>
                                    </h6>
                                </li>

                                <li class="list-group-item" v-if="
                                    anggota.member_registration
                                        .file_portofolio
                                ">
                                    <h6 class="mb-1 font-bold">
                                        File Portofolio
                                    </h6>
                                    <h6 class="mb-0">
                                        <a :href="`/storage/${anggota.member_registration.file_portofolio}`" download>
                                            Unduh File
                                        </a>
                                    </h6>
                                </li>

                                <li class="list-group-item" v-if="anggota.member_registration.skill">
                                    <h6 class="mb-1 font-bold">
                                        Skill Tambahan
                                    </h6>
                                    <h6 class="mb-0">
                                        {{ anggota.member_registration.skill }}
                                    </h6>
                                </li>

                                <!-- Studi Kasus -->
                                <li class="list-group-item">
                                    <h6 class="mb-1 font-bold">
                                        Ide untuk HMIF
                                    </h6>
                                    <h6 class="mb-0">
                                        {{
                                            anggota.member_registration.ide ||
                                            "-"
                                        }}
                                    </h6>
                                </li>

                                <li class="list-group-item">
                                    <h6 class="mb-1 font-bold">
                                        Solusi yang Ditawarkan
                                    </h6>
                                    <h6 class="mb-0">
                                        {{
                                            anggota.member_registration
                                                .solusi || "-"
                                        }}
                                    </h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
    <div v-else>
        <div class="d-flex ms-3 mb-3">
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
