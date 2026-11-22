<?php
// Runs only the [embed] shortcode over content (before wpautop), leaving other shortcodes for later.
function guide_other_shortcode() {
	return 'OTHER';
}
add_shortcode( 'other', 'guide_other_shortcode' );
return $GLOBALS['wp_embed']->run_shortcode( '[other] [embed]https://unknown.example/x[/embed]' );
