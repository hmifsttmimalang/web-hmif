<template>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <router-link class="sidebar-brand d-flex align-items-center justify-content-center" to="/admin">
            <div class="sidebar-brand-text mx-3">Admin DashHMIF</div>
        </router-link>
        <div class="sidebar-heading">Admin</div>
        <li class="nav-item">
            <router-link class="nav-link" :class="{ active: route.name === 'Admin' }" to="/admin">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </router-link>
        </li>
        <hr class="sidebar-divider" />
        <li class="nav-item">
            <router-link class="nav-link" :class="{ active: route.name === 'KelolaData' }" to="/admin/kelola-data">
                <i class="fas fa-fw fa-list"></i>
                <span>Kelola Data Anggota</span>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link class="nav-link" :class="{ active: route.name === 'Anggota' }" to="/admin/anggota">
                <i class="fas fa-fw fa-user"></i>
                <span>Anggota</span>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link class="nav-link" :class="{ active: route.name === 'InfoUser' }" to="/admin/info-user">
                <i class="fas fa-fw fa-user"></i>
                <span>Info Anggota Baru</span>
            </router-link>
        </li>
        <hr class="sidebar-divider" />
        <li class="nav-item">
            <a class="nav-link" href="#" @click.prevent="logout">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Keluar</span>
            </a>
        </li>
    </ul>
</template>
<script setup>
import { useRoute, useRouter } from 'vue-router'
import axios from '@/axios'
const route = useRoute()
const router = useRouter()
async function logout() {
    await axios.post('/logout')
    router.push('/login')
}
</script>
