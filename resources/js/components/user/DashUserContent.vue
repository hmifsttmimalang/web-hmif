<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <Link href="/">Home</Link>
                </li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>

    <!-- Content dashboard -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <b>Coming Soon</b>
                    </h6>
                </div>
                <div class="card-body">
                    <p class="text-danger mt-3">
                        * Fitur terbaru yang akan rilis bagi anggota hmif!
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <b>PEMBERITAHUAN AGENDA HMIF</b>
                    </h6>
                </div>
                <div class="card-body mt-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                Dihimbau Untuk Membaca Sampai Selesai
                            </h5>
                            <div class="col-auto">
                                <i
                                    class="fa-solid fa-spinner text-warning"
                                    style="font-size: 90px"
                                ></i>
                                <p class="card-text mt-3">
                                    Masih Belum Ada Agenda
                                </p>
                                <span
                                    class="badge bg-danger"
                                    style="font-size: 18px"
                                    >... 2025</span
                                >
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="marquee-wrapper">
                                <div class="custom-marquee">
                                    HMIF SMI MALANG
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.marquee-wrapper {
    width: 100%;
    overflow: hidden;
    position: relative;
    height: 1.5em; /* atur tinggi sesuai font/line */
}

.custom-marquee {
    display: inline-block;
    white-space: nowrap;
    animation: marquee 8s linear infinite;
    font-weight: bold;
    padding-left: 100%;
    box-sizing: content-box;
}

@keyframes marquee {
    0% {
        transform: translateX(0%);
    }
    100% {
        transform: translateX(-100%);
    }
}
</style>
