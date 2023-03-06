import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'
// https://vitejs.dev/config/
export default defineConfig({
  server:{
    host:true,
    port:3000
  },
  resolve:{
    alias:{
      '@' : path.resolve(__dirname, './src'),
    },
  },
  plugins: [vue()]
})