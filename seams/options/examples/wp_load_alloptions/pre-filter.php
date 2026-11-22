<?php
// pre_wp_load_alloptions replaces the whole set.
function guide_replace_alloptions( $alloptions ) {
	return array( 'guide' => 'yes' );
}
add_filter( 'pre_wp_load_alloptions', 'guide_replace_alloptions' );
return wp_load_alloptions();
