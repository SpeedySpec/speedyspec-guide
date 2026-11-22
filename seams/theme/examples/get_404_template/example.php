<?php
// The path of the 404 template.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
return str_replace( get_theme_root(), '<themes>', get_404_template() );
