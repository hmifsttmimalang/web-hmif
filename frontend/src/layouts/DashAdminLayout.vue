<template>
    <div id="wrapper">
        <router-view />
        <DashAdminSidebar />
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <DashAdminTopbar />
                <slot />
            </div>

        </div>
    </div>
</template>

<script setup>
import { onMounted, onUnmounted } from 'vue';
import DashAdminSidebar from '@/components/admin/DashAdminSidebar.vue';
import DashAdminTopbar from '../components/admin/DashAdminTopbar.vue';

let adminDashboard;
const linkEls = [];
const scriptEls = [];

function loadStyle(href) {
    const link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = href;
    document.head.appendChild(link);
    linkEls.push(link);
}

function loadScript(src) {
    const script = document.createElement("script");
    script.src = src;
    script.async = false;
    document.body.appendChild(script);
    scriptEls.push(script);
}

onMounted(() => {
    loadStyle("/assets/vendor/bootstrap/css/bootstrap.min.css");
    loadStyle("/assets/vendor/fontawesome-free/css/all.min.css");

    adminDashboard = document.createElement("link");
    adminDashboard.rel = "stylesheet";
    adminDashboard.href = "/assets/css/sb-admin-2.css";
    document.head.appendChild(adminDashboard);

    loadScript("/assets/vendor/jquery/jquery.min.js");
    loadScript("/assets/vendor/bootstrap/js/bootstrap.bundle.min.js");
    loadScript("/assets/js/sb-admin-2.min.js");
});

onUnmounted(() => {
    linkEls.forEach(link => link.remove());
    scriptEls.forEach(script => script.remove());
    if (adminDashboard) {
        adminDashboard.remove();
    }
});
</script>
