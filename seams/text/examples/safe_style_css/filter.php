<?php
// safe_style_css filters the list of allowed properties.
function guide_allow_behavior( $props ) {
	$props[] = 'behavior';
	return $props;
}
add_filter( 'safe_style_css', 'guide_allow_behavior' );
return safecss_filter_attr( 'behavior: none' );
