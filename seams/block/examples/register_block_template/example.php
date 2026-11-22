<?php
// Registers a block template from a plugin, by plugin//slug, with its title, description, content and post types.
$template = register_block_template( 'guide//landing', array( 'title' => 'Landing', 'content' => '<!-- wp:paragraph --><p>Hi</p><!-- /wp:paragraph -->' ) );
return array( get_class( $template ), $template->plugin, $template->slug );
