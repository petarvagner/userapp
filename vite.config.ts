import { defineConfig } from 'vite';
import vue from "@vitejs/plugin-vue";
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '0.0.0.0',
        hmr: {
            host: 'localhost'
        },
    },
    plugins: [
        vue(),
        laravel({
            input: ['resources/js/app.ts'],
            refresh: true,
        }),
    ],
});
