<?php
// Gives a taxonomy-{taxonomy}-{slug} template the title and description naming its term.
$template = new WP_Block_Template();
_wp_build_title_and_description_for_taxonomy_block_template( 'category', 'uncategorized', $template );
return $template->title;
