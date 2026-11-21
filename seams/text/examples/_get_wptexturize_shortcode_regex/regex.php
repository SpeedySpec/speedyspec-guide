<?php
// The part of that expression that matches shortcodes, given their tag names.
return (bool) preg_match( '/' . _get_wptexturize_shortcode_regex( array( 'gallery' ) ) . '/', '[gallery id="1"]' );
