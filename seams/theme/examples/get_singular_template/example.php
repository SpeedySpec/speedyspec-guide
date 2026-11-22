<?php
// The path of the singular template, singular.php.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
return str_replace( get_theme_root(), '<themes>', get_singular_template() );
