<?php
// Removes a box from an edit screen's context.
function guide_tasting_box( WP_Post $post ): void
{
	echo '<p>Tasting notes</p>';
}
add_meta_box( 'tasting', 'Tasting notes', 'guide_tasting_box', 'post', 'side' );
remove_meta_box( 'tasting', 'post', 'side' );
return $GLOBALS['wp_meta_boxes']['post']['side']['default']['tasting'];
