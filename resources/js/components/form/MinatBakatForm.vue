<script setup>
defineProps({
    form: Object,
    errors: Object,
});
</script>

<template>
    <!-- Minat dan Bakat -->
    <div class="form-group">
        <label>
            Apa minat utama kamu dalam bidang organisasi atau non akademik?
            (boleh pilih lebih dari satu)
        </label>

        <!-- List Minat -->
        <div
            v-for="option in [
                'Public Speaking',
                'Menulis',
                'Desain Grafis',
                'Editing Foto/Video',
                'Coding / Programming',
                'Lainnya',
            ]"
            :key="option"
        >
            <div class="form-check">
                <input
                    class="form-check-input"
                    type="checkbox"
                    :value="option"
                    v-model="form.minat"
                    :id="option"
                />
                <label class="form-check-label" :for="option">{{
                    option
                }}</label>
            </div>
        </div>

        <!-- Input Teks jika 'Lainnya' dipilih -->
        <div class="mt-2" v-if="form.minat.includes('Lainnya')">
            <input
                type="text"
                v-model="form.minat_lainnya"
                class="form-control"
                placeholder="Tuliskan minat lainnya..."
            />
        </div>

        <div class="invalid-feedback d-block" v-if="form.errors.minat">
            {{ form.errors.minat }}
        </div>

        <div class="invalid-feedback d-block" v-if="form.errors.minat_lainnya">
            {{ form.errors.minat_lainnya }}
        </div>
    </div>

    <!-- Pengalaman Organisasi -->
    <div class="form-group">
        <label for="pengalaman_organisasi">Apakah kamu memiliki pengalaman organisasi sebelumnya? Jika ya, sebutkan nama organisasi dan posisi kamu</label>
        <textarea
            v-model="form.pengalaman_organisasi"
            id="pengalaman_organisasi"
            class="form-control"
            placeholder="Wajib diisi"
        ></textarea>
        <div
            class="invalid-feedback d-block"
            v-if="form.errors.pengalaman_organisasi"
        >
            {{ form.errors.pengalaman_organisasi }}
        </div>
    </div>

    <!-- Divisi -->
    <div class="form-group">
        <label for="divisi">Divisi yang paling diminati</label>
        <select v-model="form.divisi" id="divisi" class="form-control" required>
            <option value="">Pilih Divisi</option>
            <option value="Humas">Hubungan Masyarakat (Humas)</option>
            <option value="Ristek">Riset dan Teknologi (Ristek)</option>
            <option value="Medkom">Media dan Dokumentasi (Medkom)</option>
            <option value="Tata Usaha">Tata Usaha</option>
            <option value="Minat dan Bakat">Minat dan Bakat</option>
        </select>
        <div class="invalid-feedback d-block" v-if="form.errors.divisi">
            {{ form.errors.divisi }}
        </div>
    </div>
</template>
