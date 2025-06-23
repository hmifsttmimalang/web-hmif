<template>
  <div v-if="show">
    <div class="modal-backdrop">
      <div class="custom-modal-center">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Yakin ingin keluar?</h5>
              <button type="button" class="close" @click="close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Pilih "Logout" di bawah ini jika Anda siap untuk mengakhiri sesi Anda saat ini.
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" @click="close">Batal</button>
              <button class="btn btn-primary" @click="logout">Logout</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script setup>
import { defineProps, defineEmits } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({ show: Boolean })
const emit = defineEmits(['close'])

function close() {
  emit('close')
}
function logout() {
  router.post('/logout')
}
</script>

<style scoped>
.modal-backdrop {
  position: fixed;
  top: 0; left: 0;
  right: 0; bottom: 0;
  background: rgba(0,0,0,0.4);
  z-index: 1050;
}
.modal {
  position: fixed;
  top: 0; left: 0; right: 0; bottom: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1100; /* lebih tinggi dari backdrop */
}

.modal-content {
  background: #fff !important;
  border-radius: 8px;
  box-shadow: 0 2px 24px rgba(0,0,0,0.5);
  border: none;
  padding: 0;
  animation: popIn .2s;
}
@keyframes popIn {
  from { transform: scale(0.95); opacity: 1; }
  to   { transform: scale(1); opacity: 1; }
}
</style>
