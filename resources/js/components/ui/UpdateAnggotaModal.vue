<script setup>
import { reactive, watch } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import Swal from "sweetalert2";

const page = usePage();
const currentUser = page.props.currentUser || {};

const props = defineProps(["anggota"]);
const emit = defineEmits(["close", "save"]);

const form = reactive({
    id_anggota: "",
    nama: "",
    role: "",
    jabatan: "",
    status: "",
});

watch(
    () => props.anggota,
    (val) => {
        if (val) {
            form.id_anggota = val.id ?? "";
            form.role = val.role ?? "";
            form.nama = val.nama ?? "";
            form.jabatan = val.jabatan ?? "";
            form.status = val.status ?? "";
        }
    },
    { immediate: true }
);

function submit() {
    emit("close");
    if (form.role === 'admin' && form.jabatan === 'Anggota') {
        Swal.fire('Tidak valid', 'Jabatan "Anggota" tidak bisa dijadikan admin.', 'warning');
        return;
    }
    Swal.fire({
        title: "Apakah kamu yakin ingin menyimpan perubahan?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Ya, simpan!",
        cancelButtonText: "Batal",
    }).then((result) => {
        Swal.fire({
            title: 'Menyimpan...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        if (result.isConfirmed) {
            router.patch(route("admin.anggota.update", { id: form.id_anggota }), form, {
                onSuccess: () => {
                    Swal.fire({
                        title: "Berhasil diubah",
                        icon: "success",
                        timer: 1500,
                        showConfirmButton: false,
                    });
                    emit("close");
                    router.visit(route("admin.kelola-data"), { preserveScroll: true });
                },
                onError: () => {
                    Swal.fire("Gagal!", "Gagal update data!", "error");
                },
            });
        }
    });
}
</script>

<template>
    <div class="modal-backdrop" @click.self="$emit('close')">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Anggota</h5>
                    <button type="button" class="btn-close" @click="$emit('close')"></button>
                </div>
                <form @submit.prevent="submit">
                    <div class="modal-body">
                        <input type="hidden" v-model="form.id_anggota" />

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" v-model="form.nama" disabled />
                        </div>

                        <div class="mb-3" v-if="currentUser.role === 'superadmin'">
                            <label class="form-label">Akses</label>
                            <select class="form-select" v-model="form.role" required>
                                <option value="" disabled>Pilih Akses</option>
                                <option value="admin" :disabled="form.jabatan === 'Anggota'">
                                    Admin (butuh jabatan tinggi)
                                </option>
                                <option value="user">Anggota</option>
                            </select>
                            <small v-if="form.jabatan === 'Anggota'" class="text-danger">
                                Jabatan harus lebih dari "Anggota" untuk bisa menjadi admin.
                            </small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jabatan</label>
                            <select class="form-select" v-model="form.jabatan" required>
                                <option value="" disabled>Pilih Jabatan</option>
                                <option value="Ketua Umum">Ketua Umum</option>
                                <option value="Wakil Ketua Umum">Wakil Ketua Umum</option>
                                <option value="Sekretaris">Sekretaris</option>
                                <option value="Bendahara">Bendahara</option>
                                <option value="Divisi Humas">Divisi Humas</option>
                                <option value="Divisi Ristek">Divisi Ristek</option>
                                <option value="Divisi Medkom">Divisi Medkom</option>
                                <option value="Divisi Tata Usaha">Divisi Tata Usaha</option>
                                <option value="Divisi Minat dan Bakat">Divisi Minat dan Bakat</option>
                                <option value="Koordinator Angkatan">Koordinator Angkatan</option>
                                <option value="Anggota">Anggota</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" v-model="form.status" required>
                                <option value="Baru">Pilih Status</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Demisioner">Demisioner</option>
                                <option value="Nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="$emit('close')">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
.modal-backdrop {
    position: fixed;
    left: 0;
    top: 0;
    width: 100vw;
    height: 100vh;
    z-index: 9999;
    background: rgba(0, 0, 0, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
