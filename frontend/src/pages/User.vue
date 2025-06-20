<template>
    <div>
        <!-- Header -->
        <header id="header" class="header fixed-top d-flex align-items-center">
            <!-- ... copy isi header dari HTML lama ... -->
            <div class="d-flex align-items-center justify-content-between">
                <router-link to="/dashboard" class="logo d-flex align-items-center">
                    <img src="@/assets/img/logo_hmif.jpg" alt="" />
                    <span class="d-none d-lg-block">DashHMIF</span>
                </router-link>
                <i class="bi bi-list toggle-sidebar-btn"></i>
            </div>
            <!-- ...lanjutan profile user dan nav... -->
        </header>

        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar">
            <ul class="sidebar-nav" id="sidebar-nav">
                <li class="nav-item">
                    <router-link class="nav-link" to="/dashboard">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link collapsed" to="/edit-profil">
                        <i class="bi bi-person-fill-gear"></i>
                        <span>Edit Profil</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" @click.prevent="logout">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span>Keluar</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main content -->
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Dashboard</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><router-link to="/dashboard">Home</router-link></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div>

            <!-- Content dashboard -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><b>Coming Soon</b></h6>
                        </div>
                        <div class="card-body">
                            <p class="text-danger mt-3">* Fitur terbaru yang akan rilis bagi anggota hmif!</p>
                            <!-- (Bisa dihapus, atau ganti dengan info real nanti) -->
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><b>PEMBERITAHUAN AGENDA HMIF</b></h6>
                        </div>
                        <div class="card-body mt-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Dihimbau Untuk Membaca Sampai Selesai</h5>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-spinner text-warning" style="font-size: 90px;"></i>
                                        <p class="card-text mt-3">Masih Belum Ada Agenda</p>
                                        <span class="badge bg-danger" style="font-size: 18px;">... 2025</span>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <marquee style="font-weight:bold;">HMIF SMI MALANG</marquee>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script setup>
import { useRouter } from "vue-router";
import { onMounted, onUnmounted } from "vue";
import axios from "@/axios";

let userDashboard;
const scriptEls = [];

function loadScript(src) {
    const script = document.createElement("script");
    script.src = src;
    script.async = false;
    document.body.appendChild(script);
    scriptEls.push(script);
}

onMounted(() => {
    userDashboard = document.createElement("link");
    userDashboard.rel = "stylesheet";
    userDashboard.href = "/assets/css/style.css";
    document.head.appendChild(userDashboard);

    loadScript("/assets2/vendor/apexcharts/apexcharts.min.js");
    loadScript("/assets2/vendor/bootstrap/js/bootstrap.bundle.min.js");
    loadScript("/assets2/vendor/chart.js/chart.umd.js");
    loadScript("/assets2/vendor/echarts/echarts.min.js");
    loadScript("/assets2/vendor/quill/quill.js");
    loadScript("/assets2/vendor/simple-datatables/simple-datatables.js");
    loadScript("/assets2/vendor/tinymce/tinymce.min.js");
    loadScript("/assets2/vendor/php-email-form/validate.js");
    loadScript("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js");
    loadScript("/assets2/js/dashUser.js");
});

onUnmounted(() => {
    if (userDashboard) {
        document.head.removeChild(userDashboard);
    }

    scriptEls.forEach(script => {
        if (script.parentNode) {
            script.parentNode.removeChild(script);
        }
    });
    scriptEls.length = 0;
});

const router = useRouter();

async function logout() {
    await axios.post("/logout");
    router.push("/login");
}
</script>
