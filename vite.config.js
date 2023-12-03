import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    // server: {
    //     host: '103.157.146.122',
    // },
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/css/adminlte-auth.css',
                'resources/js/adminlte-auth.js',
                'resources/js/adminlte-dashboard.js',
                'resources/js/jquery-3.7.1.min.js',
                'resources/css/adminlte-dashboard.css',
                'resources/css/filter.css',

            ],
            refresh: true,
        }),
    ]
});
