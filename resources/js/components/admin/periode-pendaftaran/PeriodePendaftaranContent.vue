<script setup>
import { ref, computed } from "vue";
import { useForm, usePage } from '@inertiajs/vue3';
import { route } from "ziggy-js";
import UpdatePeriodeModal from '@/components/ui/UpdatePeriodeModal.vue';
import ConfirmDeleteModal from '@/components/ui/ConfirmDeleteModal.vue';

const page = usePage();
const periods = computed(() => page.props.periods ?? []);

const toISOStringLocal = (dateString) => {
    const date = new Date(dateString);
    const offset = date.getTimezoneOffset();
    const localDate = new Date(date.getTime() - offset * 60000);
    return localDate.toISOString().slice(0, 16);
};

function formatWIB(datetime) {
    return new Intl.DateTimeFormat('id-ID', {
        timeZone: 'Asia/Jakarta',
        weekday: 'long',
        day: '2-digit',
        month: 'long',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        hour12: false,
    }).format(new Date(datetime)).replace(':', '.');
}

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
    form.start_at = toISOStringLocal(form.start_at);
    form.end_at = toISOStringLocal(form.end_at);

    form.post(route('admin.periode.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <div class="container mt-4">
        <h3 class="h3 mb-4 text-gray-800">Atur Periode Pendaftaran</h3>

        <!-- Form Tambah Periode -->
        <form @submit.prevent="submit" class="card p-4 shadow-sm mb-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="start_at" class="form-label">Tanggal Buka</label>
                    <input type="datetime-local" id="start_at" v-model="form.start_at" class="form-control" required />
                </div>
                <div class="col-md-6">
                    <label for="end_at" class="form-label">Tanggal Tutup</label>
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
                        <tr class="text-center">
                            <th>Buka Pendaftaran</th>
                            <th>Tutup Pendaftaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="p in periods" :key="p.id" class="text-center">
                            <td>{{ formatWIB(p.start_at) }}</td>
                            <td>{{ formatWIB(p.end_at) }}</td>
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
