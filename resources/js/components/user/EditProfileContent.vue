<script setup>
import { useForm, usePage, Link } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import { route } from "ziggy-js";

const user = usePage().props.currentUser || {};

const showPassword = ref(false);
const showPasswordConfirmation = ref(false);

const form = useForm({
    nama: user.nama || "",
    tempat_lahir: user.member_registration?.tempat_lahir || "",
    tanggal_lahir: user.member_registration?.tanggal_lahir || "",
    jenis_kelamin: user.member_registration?.jenis_kelamin || "",
    agama: user.member_registration?.agama || "",
    alamat: user.member_registration?.alamat || "",
    username: user.username || "",
    email: user.email || "",
    telepon: user.telepon || "",
    password: "",
    password_confirmation: "",
    foto: null,
});

const fotoPreview = ref(
    user.foto ? `/storage/${user.foto}` : "/assets2/img/default.jpg"
);

function onFileChange(e) {
    const file = e.target.files[0];
    form.foto = file || null;
    if (file) {
        fotoPreview.value = URL.createObjectURL(file);
    }
}

watch(
    () => form.foto,
    (val) => {
        if (!val) {
            fotoPreview.value = user.foto
                ? `/storage/${user.foto}`
                : "/assets2/img/default.jpg";
        }
    }
);

function submit() {
    form.transform((data) => ({
        ...data,
    })).post(route("profile.update"), {
        forceFormData: true,
        onSuccess: () => window.location.reload(),
    });
}
</script>

<template>
    <div class="pagetitle">
        <h1>Edit Profil</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <Link href="/">Home</Link>
                </li>
                <li class="breadcrumb-item active">Edit Profil User</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-8">
            <form
                class="user"
                @submit.prevent="submit"
                enctype="multipart/form-data"
            >
                <div class="form-group mb-3" v-if="user.role !== 'superadmin'">
                    <label for="nama">Nama</label>
                    <input
                        type="text"
                        v-model="form.nama"
                        class="form-control"
                        id="nama"
                        placeholder="Masukkan Nama Lengkap Anda..."
                    />
                    <div class="text-danger" v-if="form.errors.nama">
                        {{ form.errors.nama }}
                    </div>
                </div>
                <div
                    class="form-group row mb-3"
                    v-if="user.role !== 'superadmin'"
                >
                    <div class="col-md-6">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input
                            type="text"
                            v-model="form.tempat_lahir"
                            class="form-control"
                            id="tempat_lahir"
                            placeholder="Tempat Lahir Anda..."
                        />
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input
                            type="date"
                            v-model="form.tanggal_lahir"
                            class="form-control"
                            id="tanggal_lahir"
                            placeholder="Tanggal Lahir Anda..."
                        />
                    </div>
                </div>
                <div
                    class="form-group row mb-3"
                    v-if="user.role !== 'superadmin'"
                >
                    <div class="col-md-6">
                        <label>Jenis Kelamin</label>
                        <div class="form-check">
                            <input
                                type="radio"
                                v-model="form.jenis_kelamin"
                                value="L"
                                class="form-check-input"
                                id="laki"
                            />
                            <label for="laki" class="form-check-label"
                                >Laki-Laki</label
                            >
                        </div>
                        <div class="form-check">
                            <input
                                type="radio"
                                v-model="form.jenis_kelamin"
                                value="P"
                                class="form-check-input"
                                id="perempuan"
                            />
                            <label for="perempuan" class="form-check-label"
                                >Perempuan</label
                            >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="agama">Agama</label>
                        <select
                            v-model="form.agama"
                            id="agama"
                            class="form-control"
                        >
                            <option value="">Pilih Agama</option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="katolik">Katolik</option>
                            <option value="hindu">Hindu</option>
                            <option value="buddha">Buddha</option>
                            <option value="konghucu">Konghucu</option>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="alamat">Alamat</label>
                    <textarea
                        v-model="form.alamat"
                        id="alamat"
                        class="form-control"
                    ></textarea>
                </div>
                <div class="form-group row mb-3">
                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input
                            type="text"
                            v-model="form.username"
                            class="form-control"
                            id="username"
                            placeholder="Tulis username anda..."
                            required
                            maxlength="255"
                            autocomplete="username"
                        />
                        <div class="text-danger" v-if="form.errors.username">
                            {{ form.errors.username }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            v-model="form.email"
                            class="form-control"
                            id="email"
                            placeholder="Email Aktif Anda..."
                        />
                    </div>
                    <div class="col-md-6">
                        <label for="telepon">Telepon</label>
                        <input
                            type="text"
                            v-model="form.telepon"
                            class="form-control"
                            id="telepon"
                            placeholder="No Telepon Anda..."
                        />
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-md-6">
                        <label for="password">Password Baru</label>
                        <div class="input-group">
                            <input
                                :type="showPassword ? 'text' : 'password'"
                                v-model="form.password"
                                class="form-control"
                                id="password"
                                placeholder="Masukkan Password Baru..."
                            />
                            <button
                                class="btn btn-outline-secondary"
                                type="button"
                                @click="showPassword = !showPassword"
                            >
                                <i
                                    :class="
                                        showPassword
                                            ? 'bi bi-eye-slash'
                                            : 'bi bi-eye'
                                    "
                                ></i>
                            </button>
                        </div>
                        <div class="text-danger" v-if="form.errors.password">
                            {{ form.errors.password }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation"
                            >Ulangi Password</label
                        >
                        <div class="input-group">
                            <input
                                :type="
                                    showPasswordConfirmation
                                        ? 'text'
                                        : 'password'
                                "
                                v-model="form.password_confirmation"
                                class="form-control"
                                id="password_confirmation"
                                placeholder="Ulangi Password Anda..."
                            />
                            <button
                                class="btn btn-outline-secondary"
                                type="button"
                                @click="
                                    showPasswordConfirmation =
                                        !showPasswordConfirmation
                                "
                            >
                                <i
                                    :class="
                                        showPasswordConfirmation
                                            ? 'bi bi-eye-slash'
                                            : 'bi bi-eye'
                                    "
                                ></i>
                            </button>
                        </div>
                    </div>
                </div>
                <button
                    type="submit"
                    class="btn btn-primary mb-5"
                    :disabled="form.processing"
                >
                    <span
                        v-if="form.processing"
                        class="spinner-border spinner-border-sm me-2 ms-2"
                    ></span>
                    Ubah
                </button>
                <Link href="/dashboard" class="btn btn-secondary mb-5 ms-2"
                    >Kembali</Link
                >
            </form>
        </div>
        <div class="col-md-4">
            <img :src="fotoPreview" alt="foto profil" class="img-fluid" />
            <input
                type="file"
                @change="onFileChange"
                class="form-control mt-2"
            />
        </div>
    </div>
    <div v-if="form.recentlySuccessful" class="alert alert-success">
        Berhasil disimpan!
    </div>
</template>
