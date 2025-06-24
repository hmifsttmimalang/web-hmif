<script setup>
import { ref, onMounted, onUnmounted, computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import LogoutModal from "@/Components/ui/LogoutModal.vue";

const dropdownOpen = ref(false);
const dropdownRef = ref(null);
const page = usePage();
const showLogout = ref(false);

const adminUsername = computed(
    () => page.props.currentUser?.username ?? "Administrator"
);
const adminImg = computed(() =>
    page.props.currentUser?.foto
        ? `/storage/${page.props.currentUser.foto}`
        : "/assets2/img/default.jpg"
);

function toggleDropdown(e) {
    e.stopPropagation();
    dropdownOpen.value = !dropdownOpen.value;
}

function handleClickOutside(event) {
    if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
        dropdownOpen.value = false;
    }
}

onMounted(() => {
    window.addEventListener("click", handleClickOutside);
});

onUnmounted(() => {
    window.removeEventListener("click", handleClickOutside);
});
</script>

<template>
    <nav
        class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"
    >
        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <ul class="navbar-nav ml-auto">
            <!-- Search Dropdown (XS Only) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    id="searchDropdown"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown"
                >
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input
                                type="text"
                                class="form-control bg-light border-0 small"
                                placeholder="Search for..."
                                aria-label="Search"
                                aria-describedby="basic-addon2"
                            />
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

            <!-- User Dropdown -->
            <li
                class="nav-item dropdown no-arrow"
                :class="{ show: dropdownOpen }"
                ref="dropdownRef"
            >
                <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    @click.prevent="toggleDropdown"
                >
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{
                        adminUsername
                    }}</span>
                    <img
                        class="img-profile rounded-circle"
                        :src="adminImg"
                        alt="Profile"
                    />
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    :class="{ show: dropdownOpen }"
                >
                    <a
                        class="dropdown-item"
                        href="#"
                        @click.prevent="showLogout = true"
                    >
                        <i
                            class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"
                        ></i>
                        Keluar
                    </a>
                </div>
            </li>
        </ul>
    </nav>

    <LogoutModal :show="showLogout" @close="showLogout = false" />
</template>

<style scoped>
.dropdown-menu {
    display: none;
}
.dropdown-menu.show {
    display: block;
}
</style>
