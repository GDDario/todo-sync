import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

// https://vitejs.dev/config/
export default defineConfig({
  server: {
    strictPort: true,
    host: '0.0.0.0',
    port: 3000, // you can replace this port with any port
    watch: {
      usePolling: true,
    },
  },
  plugins: [react()],
})
