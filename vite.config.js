import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import inject from '@rollup/plugin-inject';

export default defineConfig({
    // server: {
    //     host: '103.157.146.122',
    // },
    plugins: [
        inject({
            jQuery : 'jquery', 
            'window.jQuery': 'jquery',
            $ : 'jquery'
        }),
        laravel({
            input: [
                'jquery',
                'resources/js/app.js',
                'resources/css/adminlte-auth.css',
                'resources/js/adminlte-auth.js',
                'resources/js/adminlte-dashboard.js',
                'resources/css/adminlte-dashboard.css',
                'resources/css/filter.css',
                // 'jquery/dist/jquery.min.js',

                'admin-lte/plugins/jquery-ui/jquery-ui.min.js',
                'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min',
                'admin-lte/plugins/chart.js/Chart.min.js',
                'admin-lte/plugins/sparklines/sparkline',
                'moment/min/moment.min.js',
                'admin-lte/plugins/daterangepicker/daterangepicker.js',
                'moment/min/locales.min.js',
                'admin-lte/plugins/jquery-knob/jquery.knob.min',
                'admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4',
                'admin-lte/plugins/summernote/summernote-bs4.min.js',
                'admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
                'admin-lte/dist/js/adminlte.min.js',
                'admin-lte/dist/js/demo',
                'admin-lte/dist/js/pages/dashboard',
                'admin-lte/plugins/ekko-lightbox/ekko-lightbox',
                'admin-lte/plugins/filterizr/jquery.filterizr.min.js',
                'admin-lte/plugins/daterangepicker/daterangepicker.js',
                'admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
                'admin-lte/plugins/bs-stepper/js/bs-stepper.min.js',
                'admin-lte/plugins/inputmask/jquery.inputmask.min.js',

            ],
            refresh: true,
        })
        
    ],
    optimizeDeps: {
        include: ["jquery"],
    },
    build : {
        rollupOptions: {
            output: {
                globals: {
                //    jquery: 'window.jQuery',
                   jquery: 'window.$'
                }
            }
        }
    }
});
