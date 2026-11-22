<?php
// The path of the search results template, search.php.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
return str_replace( get_theme_root(), '<themes>', get_search_template() );
