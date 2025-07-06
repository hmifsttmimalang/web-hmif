<script setup>
import { ref, computed, onMounted, onUnmounted } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import LogoutUserModal from "@/components/ui/LogoutUserModal.vue";

const page = usePage();
const user = computed(() => page.props.currentUser);
const showLogout = ref(false);

const dropdownOpen = ref(false);

function toggleDropdown() {
    dropdownOpen.value = !dropdownOpen.value;
}

function handleClickOutside(event) {
    const dropdown = document.querySelector(".nav-item.dropdown.pe-3");
    if (dropdown && !dropdown.contains(event.target)) {
        dropdownOpen.value = false;
    }
}
onMounted(() => {
    window.addEventListener("click", handleClickOutside);
});
onUnmounted(() => {
    window.removeEventListener("click", handleClickOutside);
});

function logout() {
    router.post(route("logout"));
}
</script>

<template>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <Link href="/dashboard" class="logo d-flex align-items-center">
            <img src="/assets/img/logo_hmif.jpg" alt="Logo HMIF" />
            <span class="d-none d-lg-block">DashHMIF</span>
            </Link>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <!-- notifications/profile icon -->
                <li class="nav-item dropdown pe-3" :class="{ show: dropdownOpen }">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        @click.prevent="toggleDropdown" :aria-expanded="dropdownOpen">
                        <img :src="user.foto ? `/storage/${user.foto}` : '/assets2/img/default.jpg'" alt="Profile"
                            class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover" />
                        <span class="d-none d-md-block dropdown-toggle ps-2">
                            {{ user.username }}
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
                        :class="{ show: dropdownOpen }">
                        <li class="dropdown-header">
                            <h6>{{ user.nama }}</h6>
                            <span>{{ user.role || "Anggota" }}</span>
                        </li>
                        <hr class="dropdown-divider" />
                        <li>
                            <Link class="dropdown-item d-flex align-items-center" href="/dashboard/edit-profil">
                            <i class="bi bi-person"></i>
                            <span>Edit Profil</span>
                            </Link>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#"
                                @click.prevent="showLogout = true">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Keluar</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <LogoutUserModal :show="showLogout" @close="showLogout = false" @logout="logout" />
</template>

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
