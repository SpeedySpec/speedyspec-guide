<?php
// Gives a single-{post_type}-{slug} template the title and description naming its post.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_name' => 'hello', 'post_status' => 'publish' ) );
$template = new WP_Block_Template();
_wp_build_title_and_description_for_single_post_type_block_template( 'post', 'hello', $template );
return $template->title;
