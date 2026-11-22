<?php
// The path of an author archive's template: author-{nicename}.php, author-{id}.php, author.php.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
guide_go( '/?author=1' );
return get_author_template();
