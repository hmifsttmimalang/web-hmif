<template>
    <DashUserLayout>
        <DashUserContent />
    </DashUserLayout>
</template>

<script setup>
import { useRouter } from "vue-router";
import axios from "@/axios";
import DashUserLayout from "@/layouts/DashUserLayout.vue";
import DashUserContent from "@/components/user/DashUserContent.vue";

const router = useRouter();

async function logout() {
    await axios.post("/logout");
    router.push("/login");
}
</script>
