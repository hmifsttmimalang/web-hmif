<script setup>
import { ref, computed } from "vue";
import { useForm, usePage } from '@inertiajs/vue3';
import { route } from "ziggy-js";
import UpdatePeriodeModal from '@/components/ui/UpdatePeriodeModal.vue';
import ConfirmDeleteModal from '@/components/ui/ConfirmDeleteModal.vue';

const page = usePage();
const periods = computed(() => page.props.periods ?? []);

const showDeleteModal = ref(false);
const selectedId = ref(null);

const showEditModal = ref(false)
const selectedPeriod = ref(null)

const openEditModal = (periode) => {
    selectedPeriod.value = { ...periode };
    showEditModal.value = true;
};

const openDeleteModal = (id) => {
    selectedId.value = id;
    showDeleteModal.value = true;
};

const confirmDelete = () => {
    form.delete(route('admin.periode.destroy', selectedId.value), {
        onSuccess: () => {
            showDeleteModal.value = false;
            selectedId.value = null;
        }
    });
};

const form = useForm({
    start_at: '',
    end_at: '',
    is_active: true,
});

const submit = () => {
    form.post(route('admin.periode.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <div class="container mt-4">
        <h2 class="mb-4 fw-bold">Atur Periode Pendaftaran</h2>

        <!-- Form Tambah Periode -->
        <form @submit.prevent="submit" class="card p-4 shadow-sm mb-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="start_at" class="form-label">Mulai Pendaftaran</label>
                    <input type="datetime-local" id="start_at" v-model="form.start_at" class="form-control" required />
                </div>
                <div class="col-md-6">
                    <label for="end_at" class="form-label">Selesai Pendaftaran</label>
                    <input type="datetime-local" id="end_at" v-model="form.end_at" class="form-control" required />
                </div>
            </div>

            <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" id="is_active" v-model="form.is_active" />
                <label class="form-check-label" for="is_active">
                    Aktifkan periode ini
                </label>
            </div>

            <button type="submit" class="btn btn-primary mt-3" :disabled="form.processing">
                Simpan Periode
            </button>
        </form>

        <!-- Tabel Periode -->
        <div class="card p-3 shadow-sm">
            <h5 class="mb-3 fw-semibold">Daftar Periode Tersimpan</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="p in periods" :key="p.id">
                            <td>{{ new Date(p.start_at).toLocaleString() }}</td>
                            <td>{{ new Date(p.end_at).toLocaleString() }}</td>
                            <td>
                                <span class="badge" :class="p.is_active ? 'bg-success' : 'bg-secondary'">
                                    {{ p.is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning me-2" @click="openEditModal(p)">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger" @click="openDeleteModal(p.id)">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                        <tr v-if="periods.length === 0">
                            <td colspan="4" class="text-center text-muted">
                                Belum ada periode pendaftaran.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <UpdatePeriodeModal v-if="showEditModal && selectedPeriod" :periode="selectedPeriod"
        @close="showEditModal = false" />

    <ConfirmDeleteModal v-if="showDeleteModal" @close="showDeleteModal = false" @confirm="confirmDelete" />
</template>
