<?php
// Hooked to init: defines IFRAME_REQUEST when the site editor previews the site (wp_site_preview=1), for users who can edit theme options.
$_GET['wp_site_preview'] = 1;
wp_initialize_site_preview_hooks();
return defined( 'IFRAME_REQUEST' );
