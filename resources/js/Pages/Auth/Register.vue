<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { route } from "ziggy-js";

import InfoPribadiForm from "@/components/form/InfoPribadiForm.vue";
import MotivasiForm from "@/components/form/MotivasiForm.vue";
import MinatBakatForm from "@/components/form/MinatBakatForm.vue";
import PortfolioForm from "@/components/form/PortfolioForm.vue";
import StudiKasusForm from "@/components/form/StudiKasusForm.vue";
import AkunKontakForm from "@/components/form/AkunKontakForm.vue";

onMounted(() => {
    const link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = "/assets/css/sb-admin-2.css";
    document.head.appendChild(link);
});

onUnmounted(() => {
    const link = document.querySelector(
        'link[href="/assets/css/sb-admin-2.css"]'
    );
    if (link) document.head.removeChild(link);
});

const step = ref(0);

const steps = [
    InfoPribadiForm,
    MotivasiForm,
    MinatBakatForm,
    PortfolioForm,
    StudiKasusForm,
    AkunKontakForm,
];

function onFileChange(e) {
    form.foto = e.target.files[0];
}

function onPortofolioChange(e) {
    form.file_portofolio = e.target.files[0];
}

const form = useForm({
    nama: "",
    tempat_lahir: "",
    tanggal_lahir: "",
    jenis_kelamin: "",
    agama: "",
    alamat: "",
    nim: "",
    prodi: "",
    angkatan: "",
    motivasi: "",
    harapan: "",
    bagi_waktu: "",
    kontribusi: "",
    pengalaman_organisasi: "",
    divisi: "",
    minat: [],
    minat_lainnya: "",
    skill: "",
    link_portofolio: "",
    file_portofolio: null,
    instagram: "",
    ide: "",
    solusi: "",
    email: "",
    telepon: "",
    password: "",
    password_confirmation: "",
    terms: false,
    foto: null,
});

function nextStep() {
    if (step.value < steps.length - 1) step.value++;
}

function prevStep() {
    if (step.value > 0) step.value--;
}

function submit() {
    const payload = { ...form.data() };

    if (!payload.telepon.startsWith("https://wa.me/")) {
        let nomor = payload.telepon;
        if (nomor.startsWith("0")) {
            nomor = "62" + nomor.slice(1);
        }
        payload.telepon = `https://wa.me/${nomor}`;
    }

    if (
        form.minat.includes("Lainnya") &&
        (!form.minat_lainnya || form.minat_lainnya.trim() === "")
    ) {
        form.errors.minat_lainnya = "Silakan isi minat lainnya.";
        return;
    }

    if (form.password !== form.password_confirmation) {
        form.errors.password_confirmation =
            "Password dan konfirmasi tidak cocok.";
        return;
    }

    if (!form.terms) {
        form.errors.terms = "Anda harus menyetujui syarat dan ketentuan.";
        return;
    }

    form.post(route("register.store"), {
        data: payload,
        forceFormData: true,
        onSuccess: () => form.reset(),
    });
}
</script>

<template>
    <Head title="Registrasi Anggota HMIF" />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">
                                Registrasi Anggota Baru HMIF
                            </h1>
                        </div>

                        <div class="text-center mb-3">
                            <small
                                >Langkah {{ step + 1 }} dari
                                {{ steps.length }}</small
                            >
                        </div>

                        <form @submit.prevent="submit" novalidate>
                            <component
                                :is="steps[step]"
                                :form="form"
                                :errors="form.errors"
                                :key="steps[step].name"
                            />

                            <!-- Foto dan angkatan-->
                            <div class="form-group row" v-show="step === 0">
                                <div class="col-md-6">
                                    <label for="foto"
                                        >Kirim foto terbaik kamu</label
                                    >
                                    <input
                                        type="file"
                                        @change="onFileChange"
                                        class="form-control"
                                        required
                                    />
                                    <div
                                        class="invalid-feedback d-block"
                                        v-if="form.errors.foto"
                                    >
                                        {{ form.errors.foto }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="angkatan">Angkatan</label>
                                    <input
                                        type="text"
                                        v-model="form.angkatan"
                                        class="form-control"
                                        id="angkatan"
                                        placeholder="Kamu Angkatan Berapa?"
                                        required
                                    />
                                    <div
                                        class="invalid-feedback d-block"
                                        v-if="form.errors.angkatan"
                                    >
                                        {{ form.errors.angkatan }}
                                    </div>
                                </div>
                            </div>

                            <!-- File Portofolio -->
                            <div class="form-group" v-show="step === 3">
                                <label for="file_portofolio"
                                    >File Portofolio (maks 10MB)</label
                                >
                                <input
                                    type="file"
                                    id="file_portofolio"
                                    @change="onPortofolioChange"
                                    class="form-control"
                                />
                                <div
                                    class="invalid-feedback d-block"
                                    v-if="form.errors.file_portofolio"
                                >
                                    {{ form.errors.file_portofolio }}
                                </div>
                            </div>

                            <hr />

                            <div class="d-flex justify-content-between mt-4">
                                <button
                                    class="btn btn-secondary"
                                    @click="prevStep"
                                    :disabled="step === 0"
                                >
                                    Kembali
                                </button>
                                <button
                                    class="btn btn-primary"
                                    @click="
                                        step < steps.length - 1
                                            ? nextStep()
                                            : submit()
                                    "
                                    :disabled="form.processing"
                                >
                                    {{
                                        step < steps.length - 1
                                            ? "Lanjut"
                                            : "Daftar"
                                    }}
                                </button>
                            </div>
                        </form>

                        <div
                            v-if="form.hasErrors"
                            class="alert alert-danger mt-3"
                        >
                            <div
                                v-for="(msg, field) in form.errors"
                                :key="field"
                            >
                                {{ msg }}
                            </div>
                        </div>
                        <div
                            v-if="form.recentlySuccessful"
                            class="alert alert-success mt-3"
                        >
                            Registrasi berhasil!
                        </div>

                        <div class="text-center mt-3">
                            <Link class="small" :href="route('login')"
                                >Sudah punya akun? Login!</Link
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
