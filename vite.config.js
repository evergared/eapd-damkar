import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '0.0.0.0',
        hmr: {
            host: 'localhost'
        }
    },
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/css/adminlte-auth.css',
                'resources/js/adminlte-auth.js',
                'resources/js/adminlte-dashboard.js',
                'resources/css/adminlte-dashboard.css',
                'public/admin-lte/adminlte.min.js',
                'public/admin-lte/demo.js',
                'public/admin-lte/filter.js',
                'public/admin-lte/ekko-lightbox.mis.js',
            ],
            refresh: true,
        }),
    ],
});
