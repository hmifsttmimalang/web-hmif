<script setup>
import { ref } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import LogoutModal from "@/components/ui/LogoutModal.vue";

const showLogout = ref(false);

const page = usePage();

function isActive(path) {
    const url =
        page.url.endsWith("/") && page.url.length > 1
            ? page.url.slice(0, -1)
            : page.url;
    const cmp =
        path.endsWith("/") && path.length > 1 ? path.slice(0, -1) : path;
    return url === cmp || url.startsWith(cmp + "/");
}

function logout() {
    router.post("/logout");
}
</script>

<template>
    <ul
        class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
        id="accordionSidebar"
    >
        <Link
            class="sidebar-brand d-flex align-items-center justify-content-center"
            href="/admin"
        >
            <div class="sidebar-brand-text mx-3">Admin DashHMIF</div>
        </Link>
        <div class="sidebar-heading">Admin</div>
        <li class="nav-item">
            <Link
                class="nav-link"
                :class="{ active: isActive('/admin') }"
                href="/admin"
            >
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </Link>
        </li>
        <hr class="sidebar-divider" />
        <div class="sidebar-heading">Dashboard User</div>
        <li class="nav-item">
            <Link class="nav-link" href="/dashboard">
                <i class="fas fa-fw fa-user"></i>
                <span>Dashboard User</span>
            </Link>
        </li>
        <hr class="sidebar-divider" />
        <li class="nav-item">
            <Link
                class="nav-link"
                :class="{ active: isActive('/admin/pendaftaran/periode') }"
                href="/admin/pendaftaran/periode"
            >
                <i class="fas fa-fw fa-clock"></i>
                <span>Kelola Waktu Pendaftaran</span>
            </Link>
        </li>
        <li class="nav-item">
            <Link
                class="nav-link"
                :class="{ active: isActive('/admin/kelola-data') }"
                href="/admin/kelola-data"
            >
                <i class="fas fa-fw fa-list"></i>
                <span>Kelola Data Anggota</span>
            </Link>
        </li>
        <li class="nav-item">
            <Link
                class="nav-link"
                :class="{ active: isActive('/admin/anggota') }"
                href="/admin/anggota"
            >
                <i class="fas fa-fw fa-users"></i>
                <span>Anggota</span>
            </Link>
        </li>
        <li class="nav-item">
            <Link
                class="nav-link"
                :class="{ active: isActive('/admin/info-user') }"
                href="/admin/info-user"
            >
                <i class="fas fa-fw fa-users"></i>
                <span>Info Anggota Baru</span>
            </Link>
        </li>
        <hr class="sidebar-divider" />
        <li class="nav-item">
            <a class="nav-link" href="#" @click.prevent="showLogout = true">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Keluar</span>
            </a>
        </li>
    </ul>
    <LogoutModal
        :show="showLogout"
        @close="showLogout = false"
        @logout="logout"
    />
</template>
