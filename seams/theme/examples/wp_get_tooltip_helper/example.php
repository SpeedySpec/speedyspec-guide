<?php
// The markup shared by tooltips and toggletips, by type; enqueue the wp-tooltip style and script where it is used.
return wp_get_tooltip_helper( 'Help text', array( 'id' => 'tip-3', 'type' => 'toggletip' ) ) === wp_get_toggletip( 'Help text', array( 'id' => 'tip-3' ) );
