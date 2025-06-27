<script setup>
defineProps({
    form: Object,
    errors: Object,
});
</script>

<template>
    <p class="text-center">Tunjukkan kemampuan terbaikmu!! <br /> Kamu bisa isi dengan skill yang kamu kuasai, atau lampirkan karya seperti desain, video, coding, tulisan atau lainnya. <br /> Belum punya portofolio? Nggak apa-apa! Cukup tulis skill yang kamu miliki saat ini</p>
    <hr />
    <div class="form-group">
        <label for="ket_portofolio"
            >Apakah kamu memiliki portofolio atau karya yang ingin dibagikan
            (jika ada)</label
        >
        <input
            type="url"
            v-model="form.ket_portofolio"
            id="ket_portofolio"
            class="form-control"
            placeholder="isi penjelasan singkat"
        />
        <div class="invalid-feedback d-block" v-if="form.errors.ket_portofolio">
            {{ form.errors.ket_portofolio }}
        </div>
    </div>

    <div class="form-group">
        <label for="link_portofolio">Link portofolio (jika ada)</label>
        <input
            type="url"
            v-model="form.link_portofolio"
            id="link_portofolio"
            class="form-control"
            placeholder="isi portofolio dengan link jika ada misalnya www.example.com"
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
