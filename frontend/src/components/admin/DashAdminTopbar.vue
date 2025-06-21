<template>
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow" :class="{ show: dropdownOpen }">
                <a class="nav-link dropdown-toggle" href="#" @click.prevent="toggleDropdown">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrator</span>
                    <img class="img-profile rounded-circle" src="/assets/img/undraw_profile.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" :class="{ show: dropdownOpen }">
                    <!-- <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profil
                    </a> -->
                    <!-- <div class="dropdown-divider"></div> -->
                    <a class="dropdown-item" href="#" @click.prevent="logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Keluar
                    </a>
                </div>
            </li>
        </ul>
    </nav>
</template>
<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useRouter } from 'vue-router'
import axios from '@/axios'

const dropdownOpen = ref(false)
const dropdownRef = ref(null)

function toggleDropdown(e) {
    e.stopPropagation()
    dropdownOpen.value = !dropdownOpen.value
}

function closeDropdown() {
    dropdownOpen.value = false
}

// Klik di luar baru nutup dropdown
function handleClickOutside(event) {
    if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
        dropdownOpen.value = false
    }
}

onMounted(() => {
    window.addEventListener('click', handleClickOutside)
})
onUnmounted(() => {
    window.removeEventListener('click', handleClickOutside)
})

const router = useRouter()
async function logout() {
    await axios.post('/logout')
    router.push('/login')
}
</script>

<style scoped>
/* Dropdown SPA fix */
.dropdown-menu {
    display: none;
}

.dropdown-menu.show {
    display: block;
}
</style>
