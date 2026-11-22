<?php
// The path of the archive template, archive-{post_type}.php first.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
guide_go( '/?m=2026' );
return str_replace( get_theme_root(), '<themes>', get_archive_template() );
