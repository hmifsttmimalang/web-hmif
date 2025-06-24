<script setup>
import { onMounted, onUnmounted } from "vue";
import DashUserHeader from "../components/user/DashUserHeader.vue";
import DashUserSidebar from "../components/user/DashUserSidebar.vue";
import ScrollTopPreloader from "../components/ScrollTopPreloader.vue";

let userDashboard;
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
    loadStyle("/assets2/vendor/bootstrap/css/bootstrap.min.css");
    loadStyle("/assets2/vendor/bootstrap-icons/bootstrap-icons.css");
    loadStyle("/assets2/vendor/boxicons/css/boxicons.min.css");
    loadStyle("/assets2/vendor/quill/quill.snow.css");
    loadStyle("/assets2/vendor/quill/quill.bubble.css");
    loadStyle("/assets2/vendor/remixicon/remixicon.css");
    loadStyle("/assets2/vendor/simple-datatables/style.css");

    userDashboard = document.createElement("link");
    userDashboard.rel = "stylesheet";
    userDashboard.href = "/assets/css/style.css";
    document.head.appendChild(userDashboard);

    loadScript("/assets2/vendor/apexcharts/apexcharts.min.js");
    loadScript("/assets2/vendor/bootstrap/js/bootstrap.bundle.min.js");
    loadScript("/assets2/vendor/chart.js/chart.umd.js");
    loadScript("/assets2/vendor/echarts/echarts.min.js");
    loadScript("/assets2/vendor/quill/quill.js");
    loadScript("/assets2/vendor/simple-datatables/simple-datatables.js");
    loadScript("/assets2/vendor/tinymce/tinymce.min.js");
    loadScript("/assets2/vendor/php-email-form/validate.js");
    loadScript(
        "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"
    );
    loadScript("/assets/js/dashUser.js");
});

onUnmounted(() => {
    if (userDashboard) {
        document.head.removeChild(userDashboard);
    }

    scriptEls.forEach((script) => {
        if (script.parentNode) {
            script.parentNode.removeChild(script);
        }
    });
    scriptEls.length = 0;
});
</script>

<template>
    <div>
        <DashUserHeader />
        <DashUserSidebar />
        <main id="main" class="main">
            <slot />
        </main>
    </div>
    <ScrollTopPreloader />
</template>
