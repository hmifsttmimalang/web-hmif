<template>
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <router-link class="nav-link" to="/dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link collapsed" to="/dashboard/edit-profil">
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
</template>