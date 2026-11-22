<?php
// Clears the themes cache and the theme roots, optionally clearing the update data.
wp_get_themes();
wp_clean_themes_cache();
return get_site_transient( 'theme_roots' );
