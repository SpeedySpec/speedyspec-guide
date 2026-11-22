<?php
// The path of the front page's template, front-page.php.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
return get_front_page_template();
