<script setup>
import { reactive, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const props = defineProps({
    periode: {
        type: Object,
        default: () => ({}),
    },
});

const emit = defineEmits(['close']);

const form = reactive({
    id: '',
    start_at: '',
    end_at: '',
    is_active: false,
});

function formatDateForInput(dateStr) {
    if (!dateStr) return '';
    const date = new Date(dateStr);
    const offset = date.getTimezoneOffset() * 60000;
    return new Date(date.getTime() - offset).toISOString().slice(0, 16);
}

watch(
    () => props.periode,
    (val) => {
        if (val) {
            form.id = val.id ?? '';
            form.start_at = val.start_at?.slice(0, 16) ?? '';
            form.end_at = val.end_at?.slice(0, 16) ?? '';
            form.is_active = Boolean(val.is_active);
        }
    },
    { immediate: true }
);

function submit() {
    router.patch(route('admin.periode.update', { id: form.id }), form, {
        onSuccess: () => {
            emit('close');
            router.visit(route("admin.periode.index"), { preserveScroll: true });
        },
        onError: () => alert('Gagal memperbarui periode.'),
    });
}
</script>

<template>
    <div class="modal-backdrop" @click.self="$emit('close')">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h6 class="modal-title text-white">Edit Periode Pendaftaran</h6>
                    <button type="button" class="btn-close btn-close-white" @click="$emit('close')"></button>
                </div>
                <form @submit.prevent="submit">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="datetime-local" v-model="form.start_at" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="datetime-local" v-model="form.end_at" class="form-control" required />
                        </div>
                        <div class="form-check">
                            <input type="checkbox" v-model="form.is_active" class="form-check-input"
                                :id="'modal_is_active_' + form.id" />
                            <label :for="'modal_is_active_' + form.id" class="form-check-label">Periode Aktif</label>
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

<style scoped>
.modal-backdrop {
    position: fixed;
    inset: 0;
    z-index: 1050;
    background: rgba(0, 0, 0, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
