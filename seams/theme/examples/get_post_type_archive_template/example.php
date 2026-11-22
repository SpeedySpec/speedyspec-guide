<?php
// The path of a post type archive's template, archive-{post_type}.php then archive.php.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
register_post_type( 'book', array( 'public' => true, 'has_archive' => true ) );
guide_go( '/?post_type=book' );
return str_replace( get_theme_root(), '<themes>', get_post_type_archive_template() );
