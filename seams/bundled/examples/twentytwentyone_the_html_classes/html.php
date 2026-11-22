<?php
// Prints the <html> element's class attribute from twentytwentyone_html_classes; nothing when there are none.
guide_theme( 'twentytwentyone' );
$none = guide_render( 'twentytwentyone_the_html_classes' );
function guide_add_extra_html_class( $classes ) {
	return trim( $classes . ' extra' );
}
add_filter( 'twentytwentyone_html_classes', 'guide_add_extra_html_class' );
return array( $none, guide_render( 'twentytwentyone_the_html_classes' ) );
