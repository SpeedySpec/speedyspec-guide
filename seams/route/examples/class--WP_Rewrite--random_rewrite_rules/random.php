<?php
// Rules for /random/, /random/{taxonomy}/{term}/, /random/{author}/... that redirect to a random post of that archive, unless a page has the random base's slug. random_rewrite_rules filters them.
$r = guide_permalinks( '/%year%/%monthnum%/%postname%/' );
function guide_first_random_rules( $rules ) {
	return array_slice( $rules, 0, 3 );
}
add_filter( 'random_rewrite_rules', 'guide_first_random_rules' );
return array( $r->get_random_base(), $r->random_rewrite_rules() );
