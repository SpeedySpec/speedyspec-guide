<?php
// Adds a box to an edit screen in a context (normal, side, advanced) and priority, with a callback that prints it.
function guide_tasting_box( WP_Post $post ): void
{
	echo '<p>Tasting notes</p>';
}
add_meta_box( 'tasting', 'Tasting notes', 'guide_tasting_box', 'post', 'side', 'high' );
return array_keys( $GLOBALS['wp_meta_boxes']['post']['side']['high'] );
