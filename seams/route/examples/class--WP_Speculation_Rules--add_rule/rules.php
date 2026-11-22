<?php
// Adds a prefetch or prerender rule with a source of list (urls) or document (where), refusing bad modes, IDs, eagerness and duplicates with a notice; immediate eagerness is only for list rules.
function guide_print_doing_it_wrong( $function_name, $message ) {
	print( wp_strip_all_tags( $message ) . "\n" );
}
add_action( 'doing_it_wrong_run', 'guide_print_doing_it_wrong', 10, 2 );
add_filter( 'doing_it_wrong_trigger_error', '__return_false' );
$rules = new WP_Speculation_Rules();
$results = array(
	$rules->add_rule( 'prefetch', 'main', array( 'where' => array( 'href_matches' => '/*' ) ) ),
	$rules->add_rule( 'prefetch', 'main', array( 'urls' => array( '/a' ) ) ),
	$rules->add_rule( 'fetch', 'x', array( 'urls' => array( '/a' ) ) ),
	$rules->add_rule( 'prerender', 'Bad ID', array( 'urls' => array( '/a' ) ) ),
	$rules->add_rule( 'prerender', 'list', array( 'urls' => array( '/a' ), 'eagerness' => 'immediate' ) ),
	$rules->add_rule( 'prerender', 'doc', array( 'where' => array(), 'eagerness' => 'immediate' ) ),
);
return array( $results, $rules->has_rule( 'prerender', 'list' ), wp_json_encode( $rules, JSON_UNESCAPED_SLASHES ) );
