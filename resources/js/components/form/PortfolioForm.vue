<script setup>
defineProps({
    form: Object,
    errors: Object,
});
</script>

<template>
    <p class="text-center">
        🌟 <strong>Tunjukkan kemampuan terbaikmu!</strong> 🌟 <br />
        Kamu bisa isi dengan <em>skill</em> yang kamu kuasai 💪, atau lampirkan karya seperti desain, video, coding, tulisan, dan lainnya 🎨🖥️📝<br />
        Belum punya portofolio? Nggak masalah! 😌 Cukup tulis skill yang kamu miliki saat ini. Kita percaya semua orang bisa berkembang 🚀
    </p>
    <hr />

    <div class="form-group">
        <label for="ket_portofolio">
            ✍️ Penjelasan singkat tentang portofolio atau karya (jika ada)
        </label>
        <input
            type="url"
            v-model="form.ket_portofolio"
            id="ket_portofolio"
            class="form-control"
            placeholder="Contoh: Karya desain poster kegiatan kampus"
        />
        <div class="invalid-feedback d-block" v-if="form.errors.ket_portofolio">
            {{ form.errors.ket_portofolio }}
        </div>
    </div>

    <div class="form-group">
        <label for="link_portofolio">🔗 Link portofolio (jika ada)</label>
        <input
            type="url"
            v-model="form.link_portofolio"
            id="link_portofolio"
            class="form-control"
            placeholder="Contoh: https://example.com/portofolio"
        />
        <div class="invalid-feedback d-block" v-if="form.errors.link_portofolio">
            {{ form.errors.link_portofolio }}
        </div>
    </div>

    <div class="form-group">
        <label for="skill">🛠️ Tools atau software yang kamu kuasai</label>
        <input
            type="text"
            v-model="form.skill"
            id="skill"
            class="form-control"
            placeholder="Contoh: Canva, Excel, Figma, Python, dll"
        />
        <div class="invalid-feedback d-block" v-if="form.errors.skill">
            {{ form.errors.skill }}
        </div>
    </div>
</template>
