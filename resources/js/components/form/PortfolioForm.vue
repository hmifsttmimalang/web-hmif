<script setup>
defineProps({
    form: Object,
    errors: Object,
});
</script>

<template>
    <div class="form-group">
        <label for="link_portofolio"
            >Apakah kamu memiliki portofolio atau karya yang ingin dibagikan
            (jika ada)</label
        >
        <input
            type="url"
            v-model="form.link_portofolio"
            id="link_portofolio"
            class="form-control"
            placeholder="Isi jika ada"
        />
        <div
            class="invalid-feedback d-block"
            v-if="form.errors.link_portofolio"
        >
            {{ form.errors.link_portofolio }}
        </div>
    </div>

    <div class="form-group">
        <label for="skill">Tools atau software yang kamu kuasai</label>
        <input
            type="text"
            v-model="form.skill"
            id="skill"
            class="form-control"
            placeholder="Contoh: Canva, Excel, Figma, Python, dan lain-lain"
        />
        <div class="invalid-feedback d-block" v-if="form.errors.skill">
            {{ form.errors.skill }}
        </div>
    </div>
</template>
