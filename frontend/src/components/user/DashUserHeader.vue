<template>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <router-link to="/dashboard" class="logo d-flex align-items-center">
                <img src="/assets/img/logo_hmif.jpg" alt="Logo HMIF" />
                <span class="d-none d-lg-block">DashHMIF</span>
            </router-link>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <!-- search icon -->
                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li>
                <!-- notifications/profile icon -->
                <li class="nav-item dropdown pe-3" :class="{ show: dropdownOpen }">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        @click.prevent="toggleDropdown" :aria-expanded="dropdownOpen">
                        <img src="/assets2/img/profile-img.jpg" alt="Profile" class="rounded-circle" />
                        <span class="d-none d-md-block dropdown-toggle ps-2">Nama Anggota</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
                        :class="{ show: dropdownOpen }">
                        <li class="dropdown-header">
                            <h6>Username</h6>
                            <span>Anggota</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <router-link class="dropdown-item d-flex align-items-center" to="/dashboard/edit-profil">
                                <i class="bi bi-person"></i>
                                <span>Edit Profil</span>
                            </router-link>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#" @click.prevent="logout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Keluar</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useRouter } from 'vue-router'
import axios from '@/axios'

const router = useRouter()
const dropdownOpen = ref(false)

function toggleDropdown() {
    dropdownOpen.value = !dropdownOpen.value
}

function handleClickOutside(event) {
    const dropdown = document.querySelector('.nav-item.dropdown.pe-3')
    if (dropdown && !dropdown.contains(event.target)) {
        dropdownOpen.value = false
    }
}
onMounted(() => {
    window.addEventListener('click', handleClickOutside)
})
onUnmounted(() => {
    window.removeEventListener('click', handleClickOutside)
})

async function logout() {
    try {
        await axios.post('/logout')
        router.push('/login')
    } catch (error) {
        console.error('Logout gagal:', error)
    }
}
</script>

<style scoped>
.nav-item.dropdown .dropdown-menu {
    display: none;
}

.nav-item.dropdown.show .dropdown-menu {
    display: block;
}

.dropdown-menu-end.profile {
  right: 16px !important;
  top: 46px !important;
}
</style>
