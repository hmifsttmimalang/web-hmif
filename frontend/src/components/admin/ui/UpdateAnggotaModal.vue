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
                        <input type="hidden" v-model="form.id_anggota">

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" v-model="form.nama" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Program Studi</label>
                            <select class="form-select" v-model="form.prodi" required>
                                <option value="" disabled>Pilih Prodi</option>
                                <option>Teknik Informatika</option>
                                <option>Teknik Sipil</option>
                                <option>Manajemen Bisnis</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Angkatan</label>
                            <input type="text" class="form-control" v-model="form.angkatan" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="$emit('close')">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script setup>
import { reactive, watch, toRefs } from 'vue'
const props = defineProps(['anggota'])
const emit = defineEmits(['close', 'save'])

const form = reactive({
    id_anggota: '',
    nama: '',
    prodi: '',
    angkatan: ''
})

// Sync ke props setiap kali anggota berubah
watch(
    () => props.anggota,
    (val) => {
        if (val) {
            form.id_anggota = val.id_anggota ?? ''
            form.nama = val.nama ?? ''
            form.prodi = val.prodi ?? ''
            form.angkatan = val.angkatan ?? ''
        }
    },
    { immediate: true }
)

function submit() {
    emit('save', { ...form })
    emit('close')
}
</script>
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
