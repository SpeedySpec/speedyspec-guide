<?php
// The attributes of the Post Content block in the block template the post being edited ($post_ID) uses, for the editor; null on classic themes.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
$id = wp_insert_post( array( 'post_title' => 'P', 'post_type' => 'page', 'post_status' => 'publish' ) );
$GLOBALS['post_ID'] = $id;
return wp_get_post_content_block_attributes();
