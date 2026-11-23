<?php
// Prints the Screen Options checkboxes to show or hide a screen's boxes.
function guide_tasting_box( WP_Post $post ): void
{
	echo '<p>Notes</p>';
}
add_meta_box( 'tasting', 'Tasting notes', 'guide_tasting_box', 'post', 'side' );
return str_contains( guide_render( fn() => meta_box_prefs( convert_to_screen( 'post' ) ) ), 'tasting-hide' );
