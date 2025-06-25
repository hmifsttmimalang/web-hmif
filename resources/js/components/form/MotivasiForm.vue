<script setup>
defineProps({
    form: Object,
    errors: Object,
});
</script>

<template>
    <!-- Motivasi -->
    <div class="form-group">
        <label for="motivasi">Apa motivasimu mengikuti open rekrutmen?</label>
        <textarea
            v-model="form.motivasi"
            id="motivasi"
            class="form-control"
            placeholder="Wajib diisi"
            required
        ></textarea>
        <div class="invalid-feedback d-block" v-if="form.errors.motivasi">
            {{ form.errors.motivasi }}
        </div>
    </div>

    <!-- Harapan -->
    <div class="form-group">
        <label for="harapan">Apa harapanmu jika terpilih?</label>
        <textarea
            v-model="form.harapan"
            id="harapan"
            class="form-control"
            placeholder="Wajib diisi"
            required
        ></textarea>
        <div class="invalid-feedback d-block" v-if="form.errors.harapan">
            {{ form.errors.harapan }}
        </div>
    </div>

    <!-- Bagi Waktu -->
    <div class="form-group">
        <label for="bagi_waktu">Bagaimana kamu membagi waktu?</label>
        <textarea
            v-model="form.bagi_waktu"
            id="bagi_waktu"
            class="form-control"
            placeholder="Wajib diisi"
            required
        ></textarea>
        <div class="invalid-feedback d-block" v-if="form.errors.bagi_waktu">
            {{ form.errors.bagi_waktu }}
        </div>
    </div>

    <!-- Kontribusi -->
    <div class="form-group">
        <label for="kontribusi"
            >Apakah kamu bersedia berkontribusi aktif dalam program kerja
            himpunan?</label
        >
        <div class="form-check">
            <input
                type="radio"
                v-model="form.kontribusi"
                value="Ya"
                class="form-check-input"
                id="ya"
                required
            />
            <label for="ya" class="form-check-label">Ya</label>
        </div>
        <div class="form-check">
            <input
                type="radio"
                v-model="form.kontribusi"
                value="Tidak"
                class="form-check-input"
                id="tidak"
                required
            />
            <label for="tidak" class="form-check-label">Tidak</label>
        </div>
        <div class="form-check">
            <input
                type="radio"
                v-model="form.kontribusi"
                value="Masih mempertimbangkan"
                class="form-check-input"
                id="masih_mempertimbangkan"
                required
            />
            <label for="masih_mempertimbangkan" class="form-check-label"
                >Masih mempertimbangkan</label
            >
        </div>
        <div class="invalid-feedback d-block" v-if="form.errors.kontribusi">
            {{ form.errors.kontribusi }}
        </div>
    </div>
</template>
