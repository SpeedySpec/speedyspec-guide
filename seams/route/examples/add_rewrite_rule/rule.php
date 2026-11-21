<?php
// Adds a rule to the bottom of the extra rules, or to the top with 'top'; a query not starting with index.php is an external rule.
add_rewrite_rule( '^guide/?$', 'index.php?guide=1' );
add_rewrite_rule( '^first/?$', 'index.php?first=1', 'top' );
add_rewrite_rule( '^ext/?$', 'ext.php' );
$r = $GLOBALS['wp_rewrite'];
return array( $r->extra_rules, $r->extra_rules_top, $r->non_wp_rules );
