<?php
// Hooked to admin_init: renders the full-page Font Library app early, without the admin template, and stops.
unset( $_GET['page'] );
return wp_font_library_intercept_render();
