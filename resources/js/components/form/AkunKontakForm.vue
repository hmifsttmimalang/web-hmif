<script setup>
import { ref } from "vue";

const showPassword = ref(false);
const showPasswordConfirmation = ref(false);

const togglePassword = () => {
    showPassword.value = !showPassword.value;
};

const togglePasswordConfirmation = () => {
    showPasswordConfirmation.value = !showPasswordConfirmation.value;
};

defineProps({
    form: Object,
    errors: Object,
});

const showModal = ref(false);
</script>

<template>
    <!-- Instagram -->
    <div class="form-group">
        <label for="instagram">Akun Instagram (jika bersedia)</label>
        <input type="text" v-model="form.instagram" class="form-control" id="instagram" placeholder="@akun_ig" />
        <div class="invalid-feedback d-block" v-if="errors.instagram">
            {{ errors.instagram }}
        </div>
    </div>

    <!-- Email & Telepon -->
    <div class="form-group row">
        <div class="col-md-6">
            <label for="email">Email</label>
            <input type="email" v-model="form.email" class="form-control" id="email" required
                placeholder="Masukkan Email" autocomplete="email" />
            <div class="invalid-feedback d-block" v-if="errors.email">
                {{ errors.email }}
            </div>
        </div>
        <div class="col-md-6">
            <label for="telepon">Nomor WhatsApp aktif</label>
            <input type="text" v-model="form.telepon" class="form-control" id="telepon" required
                placeholder="Masukkan No WA misalnya 08xxxx" />
            <div class="invalid-feedback d-block" v-if="errors.telepon">
                {{ errors.telepon }}
            </div>
        </div>
    </div>

    <!-- Password -->
    <div class="form-group row">
        <div class="col-md-6">
            <label for="password">Password</label>
            <div class="position-relative">
                <input :type="showPassword ? 'text' : 'password'" v-model="form.password" class="form-control pe-5"
                    id="password" required placeholder="Masukkan Password Kamu" />
                <span class="position-absolute end-0 top-50 translate-middle-y me-3" style="cursor: pointer"
                    @click="togglePassword">
                    <i :class="showPassword ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                </span>
            </div>
            <div class="invalid-feedback d-block" v-if="errors.password">
                {{ errors.password }}
            </div>
        </div>

        <div class="col-md-6">
            <label for="password_confirmation">Konfirmasi Password</label>
            <div class="position-relative">
                <input :type="showPasswordConfirmation ? 'text' : 'password'" v-model="form.password_confirmation"
                    class="form-control pe-5" id="password_confirmation" required
                    placeholder="Konfirmasi Password Kamu" />
                <span class="position-absolute end-0 top-50 translate-middle-y me-3" style="cursor: pointer"
                    @click="togglePasswordConfirmation">
                    <i :class="showPasswordConfirmation ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                </span>
            </div>
            <div class="invalid-feedback d-block" v-if="errors.password_confirmation">
                {{ errors.password_confirmation }}
            </div>
        </div>
    </div>

    <!-- Syarat & Ketentuan -->
    <div class="col-md-12">
        <div class="form-check">
            <input class="form-check-input" v-model="form.terms" type="checkbox" id="acceptTerms" required />
            <label class="form-check-label" for="acceptTerms">
                Saya setuju dengan
                <a href="#" @click.prevent="showModal = true">syarat dan ketentuan</a>
            </label>
        </div>
        <div class="invalid-feedback d-block" v-if="errors.terms">
            {{ errors.terms }}
        </div>
    </div>

    <!-- Modal Syarat & Ketentuan -->
    <div v-if="showModal" class="modal fade show d-block" tabindex="-1" aria-modal="true" role="dialog"
        style="background: rgba(0, 0, 0, 0.5)">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Syarat dan Ketentuan</h5>
                    <button type="button" class="btn-close" @click="showModal = false"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li>Pengguna wajib memberikan data yang valid.</li>
                        <li>Data tidak akan dibagikan tanpa izin.</li>
                        <li>
                            Pendaftaran bersifat sukarela namun harus sesuai
                            prosedur.
                        </li>
                        <li>
                            Layanan dapat berubah sewaktu-waktu tanpa
                            pemberitahuan.
                        </li>
                    </ul>
                    <p>
                        Dengan mencentang kotak persetujuan, Anda menyatakan
                        telah membaca dan menerima semua syarat di atas.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="showModal = false">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
