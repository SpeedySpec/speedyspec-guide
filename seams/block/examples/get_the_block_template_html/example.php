<?php
// The current block template rendered to HTML: shortcodes, blocks, embeds and smilies, wrapped in a wp-site-blocks div.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
$GLOBALS['_wp_current_template_content'] = '<!-- wp:paragraph --><p>Body</p><!-- /wp:paragraph -->';
return trim( get_the_block_template_html() );
