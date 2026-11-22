<?php
// The path of a tag archive's template: tag-{slug}.php, tag-{id}.php, tag.php.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
wp_insert_term( 'Red', 'post_tag' );
guide_go( '/?tag=red' );
return get_tag_template();
