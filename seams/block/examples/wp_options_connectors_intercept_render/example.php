<?php
// Hooked to admin_init: renders the full-page Connectors settings app early, without the admin template, and stops.
unset( $_GET['page'] );
return wp_options_connectors_intercept_render();
