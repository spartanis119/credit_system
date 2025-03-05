import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/scss/app.scss',
                'resources/css/style.css'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        https: true,
        hmr: {
            host: 'creditsystem-production.up.railway.app',
            protocol: 'wss', // Usa WebSocket seguro
        },
    },
    build: {
        outDir: 'public/build',
        manifest: true
    },
});
