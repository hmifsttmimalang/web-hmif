<script setup>
import { Head } from "@inertiajs/vue3";
import DashUserLayout from "@/layouts/DashUserLayout.vue";
import EditProfileContent from "@/components/user/EditProfileContent.vue";
</script>

<template>
<Head title="Edit Profil" />
    <DashUserLayout>
        <EditProfileContent />
    </DashUserLayout>
</template>
