import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        allowedHosts: [
            'bb4230ae-7bb7-4d09-baab-3db4a0f16f19-00-12d805pgory6v.pike.replit.dev'
        ],
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
