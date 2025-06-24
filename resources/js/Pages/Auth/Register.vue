<script setup>
import { onMounted, onUnmounted } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { route } from "ziggy-js";

onMounted(() => {
    const registerStylesheet = document.createElement("link");
    registerStylesheet.rel = "stylesheet";
    registerStylesheet.href = "/assets/css/sb-admin-2.css";
    document.head.appendChild(registerStylesheet);
});

onUnmounted(() => {
    const registerStylesheet = document.querySelector(
        'link[href="/assets/css/sb-admin-2.css"]'
    );
    if (registerStylesheet) {
        document.head.removeChild(registerStylesheet);
    }
});

const showModal = ref(false);

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
    alasan: "",
    email: "",
    telepon: "",
    password: "",
    password_confirmation: "",
    terms: false,
    foto: null,
});

function onFileChange(e) {
    form.foto = e.target.files[0];
}

function submit() {
    if (form.password !== form.password_confirmation) {
        form.errors.password_confirmation =
            "Password dan Konfirmasi password tidak sama!";
        return;
    }
    if (!form.terms) {
        form.errors.terms = "Anda harus menyetujui syarat dan ketentuan.";
        return;
    }

    form.post(route("register.store"), {
        forceFormData: true,
        onSuccess: () => {
            form.reset();
        },
    });
}
</script>

<template>
    <Head title="Registrasi Anggota HMIF" />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            Registrasi Anggota Baru HMIF
                                        </h1>
                                    </div>
                                    <form @submit.prevent="submit" novalidate>
                                        <!-- Nama -->
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input
                                                type="text"
                                                v-model="form.nama"
                                                class="form-control"
                                                id="nama"
                                                required
                                            />
                                            <div
                                                class="invalid-feedback d-block"
                                                v-if="form.errors.nama"
                                            >
                                                {{ form.errors.nama }}
                                            </div>
                                        </div>
                                        <!-- Tempat & Tanggal Lahir -->
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="tempat_lahir"
                                                    >Tempat Lahir</label
                                                >
                                                <input
                                                    type="text"
                                                    v-model="form.tempat_lahir"
                                                    class="form-control"
                                                    id="tempat_lahir"
                                                    required
                                                    placeholder="Tempat Lahir Anda..."
                                                />
                                                <div
                                                    class="invalid-feedback d-block"
                                                    v-if="
                                                        form.errors.tempat_lahir
                                                    "
                                                >
                                                    {{
                                                        form.errors.tempat_lahir
                                                    }}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="tanggal_lahir"
                                                    >Tanggal Lahir</label
                                                >
                                                <input
                                                    type="date"
                                                    v-model="form.tanggal_lahir"
                                                    class="form-control"
                                                    id="tanggal_lahir"
                                                    required
                                                />
                                                <div
                                                    class="invalid-feedback d-block"
                                                    v-if="
                                                        form.errors
                                                            .tanggal_lahir
                                                    "
                                                >
                                                    {{
                                                        form.errors
                                                            .tanggal_lahir
                                                    }}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Jenis Kelamin & Agama -->
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label>Jenis Kelamin</label>
                                                <div class="form-check">
                                                    <input
                                                        type="radio"
                                                        v-model="
                                                            form.jenis_kelamin
                                                        "
                                                        value="L"
                                                        class="form-check-input"
                                                        id="laki"
                                                        required
                                                    />
                                                    <label
                                                        for="laki"
                                                        class="form-check-label"
                                                        >Laki-Laki</label
                                                    >
                                                </div>
                                                <div class="form-check">
                                                    <input
                                                        type="radio"
                                                        v-model="
                                                            form.jenis_kelamin
                                                        "
                                                        value="P"
                                                        class="form-check-input"
                                                        id="perempuan"
                                                        required
                                                    />
                                                    <label
                                                        for="perempuan"
                                                        class="form-check-label"
                                                        >Perempuan</label
                                                    >
                                                </div>
                                                <div
                                                    class="invalid-feedback d-block"
                                                    v-if="
                                                        form.errors
                                                            .jenis_kelamin
                                                    "
                                                >
                                                    {{
                                                        form.errors
                                                            .jenis_kelamin
                                                    }}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="agama">Agama</label>
                                                <select
                                                    v-model="form.agama"
                                                    id="agama"
                                                    class="form-control"
                                                    required
                                                >
                                                    <option value="">
                                                        Pilih Agama
                                                    </option>
                                                    <option value="islam">
                                                        Islam
                                                    </option>
                                                    <option value="kristen">
                                                        Kristen
                                                    </option>
                                                    <option value="katolik">
                                                        Katolik
                                                    </option>
                                                    <option value="hindu">
                                                        Hindu
                                                    </option>
                                                    <option value="buddha">
                                                        Buddha
                                                    </option>
                                                    <option value="konghucu">
                                                        Konghucu
                                                    </option>
                                                </select>
                                                <div
                                                    class="invalid-feedback d-block"
                                                    v-if="form.errors.agama"
                                                >
                                                    {{ form.errors.agama }}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Alamat -->
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea
                                                v-model="form.alamat"
                                                id="alamat"
                                                class="form-control"
                                                required
                                            ></textarea>
                                            <div
                                                class="invalid-feedback d-block"
                                                v-if="form.errors.alamat"
                                            >
                                                {{ form.errors.alamat }}
                                            </div>
                                        </div>
                                        <!-- NIM -->
                                        <div class="form-group">
                                            <label for="nim">NIM</label>
                                            <input
                                                type="number"
                                                v-model="form.nim"
                                                class="form-control"
                                                id="nim"
                                                required
                                                placeholder="Masukkan NIM Lengkap Anda..."
                                            />
                                            <div
                                                class="invalid-feedback d-block"
                                                v-if="form.errors.nim"
                                            >
                                                {{ form.errors.nim }}
                                            </div>
                                        </div>
                                        <!-- Prodi -->
                                        <div class="form-group">
                                            <label for="prodi"
                                                >Asal Prodi</label
                                            >
                                            <select
                                                v-model="form.prodi"
                                                id="prodi"
                                                class="form-control"
                                                required
                                            >
                                                <option
                                                    value=""
                                                    disabled
                                                    selected
                                                    hidden
                                                >
                                                    Pilih Prodi
                                                </option>
                                                <option
                                                    value="Teknik Informatika"
                                                >
                                                    Teknik Informatika
                                                </option>
                                                <option value="Teknik Sipil">
                                                    Teknik Sipil
                                                </option>
                                                <option
                                                    value="Digital Arsitektur"
                                                >
                                                    Digital Arsitektur
                                                </option>
                                                <option
                                                    value="Manajemen Bisnis"
                                                >
                                                    Manajemen Bisnis
                                                </option>
                                                <option
                                                    value="Manajemen Keuangan"
                                                >
                                                    Manajemen Keuangan
                                                </option>
                                                <option
                                                    value="Manajemen Perkantoran"
                                                >
                                                    Manajemen Perkantoran
                                                </option>
                                                <option
                                                    value="Manajemen Komunikasi"
                                                >
                                                    Manajemen Komunikasi
                                                </option>
                                                <option
                                                    value="Multimedia Broadcasting"
                                                >
                                                    Multimedia Broadcasting
                                                </option>
                                                <option value="Desain Grafis">
                                                    Desain Grafis
                                                </option>
                                            </select>
                                            <div
                                                class="invalid-feedback d-block"
                                                v-if="form.errors.prodi"
                                            >
                                                {{ form.errors.prodi }}
                                            </div>
                                        </div>
                                        <!-- Foto -->
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="foto"
                                                    >Foto PAS (3x4)</label
                                                >
                                                <input
                                                    id="foto"
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
                                                <label for="angkatan"
                                                    >Angkatan</label
                                                >
                                                <input
                                                    type="text"
                                                    v-model="form.angkatan"
                                                    class="form-control"
                                                    id="angkatan"
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
                                        <!-- Alasan -->
                                        <div class="form-group">
                                            <label for="alasan"
                                                >Alasan Ingin Bergabung</label
                                            >
                                            <textarea
                                                v-model="form.alasan"
                                                id="alasan"
                                                class="form-control"
                                                required
                                            ></textarea>
                                            <div
                                                class="invalid-feedback d-block"
                                                v-if="form.errors.alasan"
                                            >
                                                {{ form.errors.alasan }}
                                            </div>
                                        </div>
                                        <!-- Email & Telepon -->
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="email">Email</label>
                                                <input
                                                    type="email"
                                                    v-model="form.email"
                                                    class="form-control"
                                                    id="email"
                                                    required
                                                    placeholder="Email Aktif Anda..."
                                                    autocomplete="email"
                                                />
                                                <div
                                                    class="invalid-feedback d-block"
                                                    v-if="form.errors.email"
                                                >
                                                    {{ form.errors.email }}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="telepon"
                                                    >Telepon</label
                                                >
                                                <input
                                                    type="text"
                                                    v-model="form.telepon"
                                                    class="form-control"
                                                    id="telepon"
                                                    required
                                                    placeholder="No Telepon Anda..."
                                                />
                                                <div
                                                    class="invalid-feedback d-block"
                                                    v-if="form.errors.telepon"
                                                >
                                                    {{ form.errors.telepon }}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Password -->
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="password"
                                                    >Password</label
                                                >
                                                <input
                                                    type="password"
                                                    v-model="form.password"
                                                    class="form-control"
                                                    id="password"
                                                    required
                                                    placeholder="Masukkan Password Anda..."
                                                />
                                                <div
                                                    class="invalid-feedback d-block"
                                                    v-if="form.errors.password"
                                                >
                                                    {{ form.errors.password }}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label
                                                    for="password_confirmation"
                                                    >Konfirmasi Password</label
                                                >
                                                <input
                                                    type="password"
                                                    v-model="
                                                        form.password_confirmation
                                                    "
                                                    class="form-control"
                                                    id="password_confirmation"
                                                    required
                                                    placeholder="Konfirmasi Password Anda..."
                                                />
                                                <div
                                                    class="invalid-feedback d-block"
                                                    v-if="
                                                        form.errors
                                                            .password_confirmation
                                                    "
                                                >
                                                    {{
                                                        form.errors
                                                            .password_confirmation
                                                    }}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Syarat & Ketentuan -->
                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input"
                                                    v-model="form.terms"
                                                    type="checkbox"
                                                    id="acceptTerms"
                                                    required
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="acceptTerms"
                                                >
                                                    Saya setuju dengan
                                                    <a
                                                        href="#"
                                                        @click.prevent="
                                                            showModal = true
                                                        "
                                                        >syarat dan ketentuan</a
                                                    >
                                                </label>
                                            </div>
                                            <div
                                                class="invalid-feedback d-block"
                                                v-if="form.errors.terms"
                                            >
                                                {{ form.errors.terms }}
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div
                                            v-if="showModal"
                                            class="modal fade show d-block"
                                            tabindex="-1"
                                            aria-modal="true"
                                            role="dialog"
                                            style="
                                                background: rgba(0, 0, 0, 0.5);
                                            "
                                        >
                                            <div
                                                class="modal-dialog modal-dialog-scrollable"
                                            >
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            Syarat dan Ketentuan
                                                        </h5>
                                                        <button
                                                            type="button"
                                                            class="btn-close"
                                                            @click="
                                                                showModal = false
                                                            "
                                                        ></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <ul>
                                                            <li>
                                                                Pengguna wajib
                                                                memberikan data
                                                                yang valid.
                                                            </li>
                                                            <li>
                                                                Data yang
                                                                dikirimkan tidak
                                                                akan dibagikan
                                                                tanpa izin.
                                                            </li>
                                                            <li>
                                                                Pendaftaran
                                                                bersifat
                                                                sukarela namun
                                                                harus sesuai
                                                                prosedur.
                                                            </li>
                                                            <li>
                                                                Layanan ini
                                                                dapat berubah
                                                                sewaktu-waktu
                                                                tanpa
                                                                pemberitahuan
                                                                sebelumnya.
                                                            </li>
                                                        </ul>
                                                        <p>
                                                            Dengan mencentang
                                                            kotak persetujuan,
                                                            Anda telah membaca
                                                            dan menerima semua
                                                            syarat dan ketentuan
                                                            di atas.
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary"
                                                            @click="
                                                                showModal = false
                                                            "
                                                        >
                                                            Tutup
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br />
                                        <button
                                            type="submit"
                                            class="btn btn-primary btn-user btn-block"
                                            :disabled="form.processing"
                                        >
                                            Registrasi
                                        </button>
                                    </form>
                                    <hr />
                                    <div class="text-center">
                                        <Link
                                            class="small"
                                            :href="route('login')"
                                            >Sudah punya akun? Login!</Link
                                        >
                                    </div>
                                    <!-- Notif error/sukses -->
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
