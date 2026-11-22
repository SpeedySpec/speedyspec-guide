<?php
// The inline script making the Categories block's dropdown go to the chosen term.
$script = build_dropdown_script_block_core_categories( 'wp-block-categories-1' );
return str_contains( $script, 'wp-block-categories-1' );
