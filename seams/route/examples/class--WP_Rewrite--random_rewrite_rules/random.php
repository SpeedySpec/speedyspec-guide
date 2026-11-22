<?php
// Rules for /random/, /random/{taxonomy}/{term}/, /random/{author}/... that redirect to a random post of that archive, unless a page has the random base's slug. random_rewrite_rules filters them.
$r = guide_permalinks( '/%year%/%monthnum%/%postname%/' );
add_filter( 'random_rewrite_rules', fn( $rules ) => array_slice( $rules, 0, 3 ) );
return array( $r->get_random_base(), $r->random_rewrite_rules() );
