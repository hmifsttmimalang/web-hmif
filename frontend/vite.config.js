import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [vue()],
  resolve: {
    alias: {
      '@': '/src',
    },
  },
  server: {
    proxy: {
      '/login': 'http://localhost:8000',
      '/logout': 'http://localhost:8000',
      '/sanctum': 'http://localhost:8000',
      '/api': 'http://localhost:8000',
    },
  },
})
