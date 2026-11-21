<?php
// On a single site it does nothing.
wp_load_core_site_options();
return wp_cache_get( '1:site_name', 'site-options' );
