
import 'bootstrap4/dist/js/bootstrap.bundle';
import 'admin-lte';

import 'admin-lte/plugins/inputmask/jquery.inputmask.min.js';
import 'admin-lte/plugins/jquery-ui/jquery-ui.min.js';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min';
import 'admin-lte/plugins/chart.js/Chart.min.js';
import 'admin-lte/plugins/sparklines/sparkline';
import 'moment/min/moment.min.js';
import 'admin-lte/plugins/daterangepicker/daterangepicker.js';
import 'moment/min/locales.min.js';
import 'admin-lte/plugins/jquery-knob/jquery.knob.min';
import 'admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4';
import 'admin-lte/plugins/summernote/summernote-bs4.min.js';
import 'admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js';
import 'admin-lte/dist/js/adminlte.min.js';
import 'admin-lte/dist/js/demo';
import 'admin-lte/dist/js/pages/dashboard';
import 'admin-lte/plugins/ekko-lightbox/ekko-lightbox';
import 'admin-lte/plugins/filterizr/jquery.filterizr.min.js';
import 'admin-lte/plugins/daterangepicker/daterangepicker.js';
import 'admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js';
import 'admin-lte/plugins/bs-stepper/js/bs-stepper.min.js';


$.widget.bridge('uibutton',$.ui.button);



$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox({
    alwaysShowClose: true
    });
});

$('.filter-container').filterizr({gutterPixels: 3});

$('.btn[data-filter]').on('click', function() {
    $('.btn[data-filter]').removeClass('active');
    $(this).addClass('active');
});

