<?php
// Post content passes through the_content's filters before it is shown: quotes, paragraphs, then shortcodes.
function my_plugin_year_shortcode() {
	return '1965';
}
add_shortcode( 'my_plugin_year', 'my_plugin_year_shortcode' );

return apply_filters( 'the_content', "\"Dune\" -- published in [my_plugin_year].\n\nStill read today..." );
