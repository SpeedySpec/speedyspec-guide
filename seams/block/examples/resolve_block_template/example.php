<?php
// The block template to render for a template type and its candidates, a saved or theme one by hierarchy, or null.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
return resolve_block_template( 'single', array( 'single-post.php', 'single.php' ), '' )->slug;
