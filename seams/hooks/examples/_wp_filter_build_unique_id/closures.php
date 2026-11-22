<?php
// A closure is keyed by its object: the same closure has one key, a new closure another, so a closure added
// directly can never be removed (add named functions instead).
$f = function () {};
$g = function () {};

return array(
	_wp_filter_build_unique_id( 'guide', $f, 10 ) === _wp_filter_build_unique_id( 'guide', $f, 10 ),
	_wp_filter_build_unique_id( 'guide', $f, 10 ) === _wp_filter_build_unique_id( 'guide', $g, 10 ),
);
