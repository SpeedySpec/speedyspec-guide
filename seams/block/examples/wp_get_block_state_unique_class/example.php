<?php
// A class unique to a block's state rules, from their hash.
return (bool) preg_match( '/^wp-states-[0-9a-f]+$/', wp_get_block_state_unique_class( 'core/button', array( array( 'selector' => 'a', 'declarations' => array() ) ) ) ) ?: wp_get_block_state_unique_class( 'core/button', array() );
