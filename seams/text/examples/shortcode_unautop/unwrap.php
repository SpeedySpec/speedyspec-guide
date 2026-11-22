<?php
// Removes the paragraph wpautop() put around a shortcode on its own line.
function guide_empty_gallery_shortcode() {
	return '';
}
add_shortcode( 'gallery', 'guide_empty_gallery_shortcode' );
return shortcode_unautop( '<p>[gallery]</p>' );
