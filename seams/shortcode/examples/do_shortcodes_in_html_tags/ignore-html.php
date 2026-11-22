<?php
// With $ignore_html, shortcodes inside HTML tags are escaped instead of run, so do_shortcode() leaves them as text.
function guide_url_shortcode() {
	return esc_url( 'https://example.org/' );
}
add_shortcode( 'url', 'guide_url_shortcode' );
return do_shortcodes_in_html_tags( '<a href="[url]">[url]</a>', true, array( 'url' ) );
