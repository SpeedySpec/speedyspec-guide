<?php
// Balances tags only when use_balanceTags is on, or when forced.
function guide_use_balancetags_off( $pre_option ) {
	return '0';
}
add_filter( 'pre_option_use_balanceTags', 'guide_use_balancetags_off' );
return array( balanceTags( '<b>open' ), balanceTags( '<b>open', true ) );
