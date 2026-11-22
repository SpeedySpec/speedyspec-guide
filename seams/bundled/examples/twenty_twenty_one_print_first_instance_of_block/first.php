<?php
// Prints the first block (or first few) of a name in some content (the post's by default), a trailing * matching a prefix; whether any was found.
guide_theme( 'twentytwentyone' );
$content = '<!-- wp:paragraph --><p>One</p><!-- /wp:paragraph --><!-- wp:image --><figure class="wp-block-image"><img src="a.jpg"/></figure><!-- /wp:image -->';
ob_start();
$found = twenty_twenty_one_print_first_instance_of_block( 'core/im*', $content );
$html = trim( ob_get_clean() );
return array( $found, $html, twenty_twenty_one_print_first_instance_of_block( 'core/gallery', $content ) );
