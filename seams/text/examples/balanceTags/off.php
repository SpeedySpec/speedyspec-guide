<?php
// Balances tags only when use_balanceTags is on, or when forced.
add_filter( 'pre_option_use_balanceTags', fn() => '0' );
return array( balanceTags( '<b>open' ), balanceTags( '<b>open', true ) );
