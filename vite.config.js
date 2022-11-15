import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                // 'resources/css/securex-bootstrap.min.css',
                // 'resources/css/securex-style.css',
                'resources/js/app.js',
                // 'resources/js/securex.js',
            ],
            refresh: true,
        }),
    ],
});
