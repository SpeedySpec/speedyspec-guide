<?php
// The active parent theme's folder path; filtered by template_directory.
switch_theme( 'twentytwentyfive' );
return str_replace( WP_CONTENT_DIR, '<content>', get_template_directory() );
