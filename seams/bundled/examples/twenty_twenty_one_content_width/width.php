<?php
// Sets $content_width to 750, as twenty_twenty_one_content_width filters it; on after_setup_theme, early.
guide_theme( 'twentytwentyone' );
$default = $GLOBALS['content_width'];
add_filter( 'twenty_twenty_one_content_width', fn() => 900 );
twenty_twenty_one_content_width();
return array( $default, $GLOBALS['content_width'] );
