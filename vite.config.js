import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/adminlte-auth.css',
                'resources/css/adminlte-dashboard.css',
                // 'resources/css/securex-style.css',
                'resources/js/app.js',
                'resources/js/adminlte-auth.js',
                'resources/js/adminlte-dashboard.js',
            ],
            refresh: true,
        }),
    ],
});
