<?php
// The element selectors (link, heading, button and the rest) under a block's root selector.
return array_slice( wp_get_block_state_element_selectors( '.wp-block-group' ), 0, 3, true );
