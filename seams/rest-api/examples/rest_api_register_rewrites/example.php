<?php
// Adds the rewrite rules that send /wp-json/ and /wp-json/<route> to index.php?rest_route=..., at the top.
global $wp_rewrite;
rest_api_register_rewrites();
return array_slice( $wp_rewrite->extra_rules_top, 0, 2, true );
