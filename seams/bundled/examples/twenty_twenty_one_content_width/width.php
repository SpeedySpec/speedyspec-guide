<?php
// Sets $content_width to 750, as twenty_twenty_one_content_width filters it; on after_setup_theme, early.
guide_theme( 'twentytwentyone' );
$default = $GLOBALS['content_width'];
function guide_wider_content( $width ) {
	return 900;
}
add_filter( 'twenty_twenty_one_content_width', 'guide_wider_content' );
twenty_twenty_one_content_width();
return array( $default, $GLOBALS['content_width'] );
