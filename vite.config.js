import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  plugins: [vue()],
  server: {
    host: true,           // így minden IP-n elérhető lesz (nem csak localhost)
    port: 5173,           // opcionális, de jó fixálni
    strictPort: true,     // ha 5173 nem szabad, ne váltson másikra
    cors: true            // CORS engedélyezése
  }
});
