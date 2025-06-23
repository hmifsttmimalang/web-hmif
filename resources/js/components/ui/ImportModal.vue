<template>
    <div class="modal-backdrop" @click.self="$emit('close')">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data Anggota</h5>
                    <button type="button" class="btn-close" @click="$emit('close')"></button>
                </div>
                <form @submit.prevent="submit">
                    <div class="modal-body">
                        <p>Silakan unggah file Excel (.xlsx) yang berisi data anggota.</p>
                        <div class="mb-3">
                            <label class="form-label">Pilih File</label>
                            <input class="form-control" type="file" accept=".xlsx,.csv" @change="onFileChange" required>
                        </div>
                        <div class="alert alert-info small">
                            Format file harus berisi kolom: <strong>Nama, Prodi, Angkatan, Email, No. HP, Jabatan dan
                                Foto Pas 3x4</strong>.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="$emit('close')">Batal</button>
                        <button type="submit" class="btn btn-warning">Import Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue'
const emit = defineEmits(['close', 'import'])
const file = ref(null)

function onFileChange(e) {
    file.value = e.target.files[0]
}
function submit() {
    if (file.value) emit('import', file.value)
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
