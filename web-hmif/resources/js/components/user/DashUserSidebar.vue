<script setup>
import { ref, computed } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import { route as ziggyRoute } from "ziggy-js";
import LogoutUserModal from "@/components/ui/LogoutUserModal.vue";

// Dapatkan current path
const page = usePage();
const currentUrl = computed(() => page.url);
const showLogout = ref(false);
const currentUser = computed(() => page.props.currentUser || {});

// Logout function pakai inertia
function logout() {
    router.post(ziggyRoute("logout"));
}
</script>

<template>
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <Link
                    :class="[
                        'nav-link',
                        currentUrl === '/dashboard' ? 'active' : '',
                    ]"
                    href="/dashboard"
                >
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </Link>
            </li>
            <li class="nav-item">
                <Link
                    :class="[
                        'nav-link',
                        currentUrl === '/dashboard/edit-profil' ? 'active' : '',
                    ]"
                    href="/dashboard/edit-profil"
                >
                    <i class="bi bi-person-fill-gear"></i>
                    <span>Edit Profil</span>
                </Link>
            </li>
                        <li
                v-if="currentUser.role === 'admin'"
                class="nav-item"
            >
                <Link
                    :class="['nav-link', currentUrl.startsWith('/admin') ? 'active' : '']"
                    href="/admin"
                >
                    <i class="bi bi-shield-lock"></i>
                    <span>Admin Dashboard</span>
                </Link>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" @click.prevent="showLogout = true">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Keluar</span>
                </a>
            </li>
        </ul>
    </aside>
    <LogoutUserModal
        :show="showLogout"
        @close="showLogout = false"
        @logout="logout"
    />
</template>

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
