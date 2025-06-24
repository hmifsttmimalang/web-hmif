<script setup>
import { defineProps, defineEmits } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({ show: Boolean });
const emit = defineEmits(["close"]);

function close() {
    emit("close");
}
function logout() {
    router.post("/logout");
}
</script>

<template>
    <div v-if="show" class="custom-modal-backdrop">
        <div class="custom-modal-center">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mb-0">Yakin ingin keluar?</h5>
                        <button
                            type="button"
                            class="close"
                            @click="close"
                            style="
                                border: none;
                                background: none;
                                font-size: 1.4rem;
                            "
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Pilih <b>"Logout"</b> di bawah ini jika Anda siap untuk
                        mengakhiri sesi Anda saat ini.
                    </div>
                    <div class="modal-footer d-flex justify-content-end gap-2">
                        <button class="btn btn-secondary" @click="close">
                            Batal
                        </button>
                        <button class="btn btn-primary" @click="logout">
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.custom-modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    z-index: 1050;
    display: flex;
    align-items: center;
    justify-content: center;
}

.custom-modal-center {
    width: 100vw;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding-top: 48px;
    min-height: 100vh;
}

.modal-dialog {
    max-width: 370px;
    margin: 0;
}

.modal-content {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 32px rgba(0, 0, 0, 0.18);
    border: none;
    padding: 0;
    opacity: 1;
    animation: popIn 0.18s;
}

.modal-header {
    border-bottom: 1px solid #eee;
    padding: 16px 20px 12px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.modal-title {
    font-size: 1.22rem;
    font-weight: 600;
}

.close {
    font-size: 1.4rem;
    cursor: pointer;
    line-height: 1;
}

.modal-body {
    padding: 12px 20px 2px 20px;
    color: #333;
    font-size: 1rem;
}

.modal-footer {
    border-top: 1px solid #eee;
    padding: 12px 20px 12px 20px;
    display: flex;
    gap: 8px;
    justify-content: flex-end;
}

.btn {
    min-width: 72px;
    font-size: 0.98rem;
}

.btn-primary {
    background: #0066ee;
    border: none;
}

.btn-primary:hover {
    background: #004aad;
}
.btn-secondary {
    background: #6c757d;
    border: none;
}

.btn-secondary:hover {
    background: #525a61;
}

@keyframes popIn {
    from {
        transform: scale(0.95);
        opacity: 0.85;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}
</style>
