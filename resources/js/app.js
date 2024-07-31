import './bootstrap';

import Alpine from 'alpinejs';
// Import Bootstrap core JavaScript
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

// Import Core plugin JavaScript
import 'jquery.easing/jquery.easing.min.js';

// Custom scripts for all pages
import './sb-admin-2.min.js';

// Page level plugins
import 'datatables.net/js/jquery.dataTables.min.js';
import 'datatables.net-bs4/js/dataTables.bootstrap4.min.js';

// Page level custom scripts
import './datatables-demo.js';

window.Alpine = Alpine;

Alpine.start();
