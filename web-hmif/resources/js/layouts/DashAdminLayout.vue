<template>
    <div id="wrapper">
        <DashAdminSidebar />
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <DashAdminTopbar />
                <slot />
            </div>
        </div>
    </div>
    <ScrollTopPreloader />
</template>

<script setup>
import { onMounted, onUnmounted } from 'vue';
import DashAdminSidebar from '@/components/admin/DashAdminSidebar.vue';
import DashAdminTopbar from '@/components/admin/DashAdminTopbar.vue';
import ScrollTopPreloader from '@/components/ScrollTopPreloader.vue';

const styleHrefs = [
    "/assets/vendor/bootstrap/css/bootstrap.min.css",
    "/assets/vendor/fontawesome-free/css/all.min.css",
    "/assets/css/sb-admin-2.css",
];
const scriptSrcs = [
    "/assets/vendor/jquery/jquery.min.js",
    "/assets/vendor/bootstrap/js/bootstrap.bundle.min.js",
    "/assets/js/sb-admin-2.min.js",
];

const loadedLinks = [];
const loadedScripts = [];

function loadStyle(href) {
    // Cek biar tidak double
    if (![...document.head.querySelectorAll("link")].some(l => l.href.includes(href))) {
        const link = document.createElement("link");
        link.rel = "stylesheet";
        link.href = href;
        document.head.appendChild(link);
        loadedLinks.push(link);
    }
}

function loadScript(src) {
    // Cek biar tidak double
    if (![...document.body.querySelectorAll("script")].some(s => s.src.includes(src))) {
        const script = document.createElement("script");
        script.src = src;
        script.async = false;
        document.body.appendChild(script);
        loadedScripts.push(script);
    }
}

onMounted(() => {
    styleHrefs.forEach(loadStyle);
    scriptSrcs.forEach(loadScript);
});

onUnmounted(() => {
    loadedLinks.forEach(link => link.remove());
    loadedScripts.forEach(script => script.remove());
});
</script>
