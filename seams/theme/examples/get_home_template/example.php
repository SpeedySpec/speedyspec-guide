<?php
// The path of the blog home's template: home.php, then index.php.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
return str_replace( get_theme_root(), '<themes>', get_home_template() );
