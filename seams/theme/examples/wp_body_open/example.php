<?php
// Fires wp_body_open, for themes to call right after the opening body tag.
add_action( 'wp_body_open', 'guide_skip_link' );
function guide_skip_link() {
	echo '<a href="#main">Skip</a>';
}
return guide_render( 'wp_body_open' );
