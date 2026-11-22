<?php
// The path of the index template; get_query_template() for index.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
return str_replace( get_theme_root(), '<themes>', get_index_template() );
