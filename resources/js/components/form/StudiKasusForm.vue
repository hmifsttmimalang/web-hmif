<script setup>
defineProps({
    form: Object,
    errors: Object,
});
</script>

<template>
    <div class="form-group">
        <label for="ide"
            >Jika kamu menjadi panitia acara seminar teknologi, ide atau
            kontribusi apa yang bisa kamu berikan?</label
        >
        <textarea
            v-model="form.ide"
            id="ide"
            class="form-control"
            placeholder="Wajib diisi"
            required
        ></textarea>
        <div class="invalid-feedback d-block" v-if="form.errors.ide">
            {{ form.errors.ide }}
        </div>
    </div>

    <div class="form-group">
        <label for="solusi"
            >Bagaimana cara kamu menyelesaikan konflik dalam tim?</label
        >
        <textarea
            v-model="form.solusi"
            id="solusi"
            class="form-control"
            placeholder="Wajib diisi"
            required
        ></textarea>
        <div class="invalid-feedback d-block" v-if="form.errors.solusi">
            {{ form.errors.solusi }}
        </div>
    </div>
</template>
