<template>
    <DashUserLayout>
        <EditProfileContent />
    </DashUserLayout>
</template>

<script setup>
import { useRouter } from "vue-router";
import axios from "@/axios";
import DashUserLayout from "@/layouts/DashUserLayout.vue";
import EditProfileContent from "@/components/user/EditProfileContent.vue";

const router = useRouter();
async function logout() {
    try {
        await axios.post("/logout");
        router.push("/login");
    } catch (error) {
        console.error("Logout gagal:", error);
    }
}
</script>