<?php
$junk = array();
for ( $i = 0; $i < 2000; $i++ ) {
	$junk[] = str_repeat( chr( 65 + $i % 26 ), 64 );
}
return \SpeedySpec\Hooks\Hook::filter( 'guide_leak', 'v' );
