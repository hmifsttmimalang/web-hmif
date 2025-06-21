<template>
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <router-link :class="['nav-link', route.name === 'User' ? 'active' : '']" to="/dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :class="['nav-link', route.name === 'EditProfil' ? 'active' : '']"
                    to="/dashboard/edit-profil">
                    <i class="bi bi-person-fill-gear"></i>
                    <span>Edit Profil</span>
                </router-link>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" @click.prevent="logout">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Keluar</span>
                </a>
            </li>
        </ul>
    </aside>
</template>

<script setup>
import { useRoute, useRouter } from 'vue-router';
import axios from '@/axios';

const route = useRoute();
const router = useRouter();


async function logout() {
  try {
    await axios.post('/logout')
    router.push('/')
  } catch (error) {
    console.error('Logout gagal:', error)
  }
}
</script>

<style scoped>
.sidebar-nav .nav-link.active {
    background: #1bbca1 !important;
    color: #fff !important;
}
.sidebar-nav .nav-link.active i {
    color: #fff !important;
}
.sidebar-nav .nav-link:hover {
    background: #1bbca1 !important;
    color: #fff !important;
}
.sidebar-nav .nav-link:hover i {
    color: #fff !important;
}
</style>
