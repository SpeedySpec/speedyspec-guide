<?php
// The part of a block's selector naming another block before it, such as .wp-block-list > for List Item, which must stay in scoped state selectors.
return array( wp_get_state_selector_ancestor( '.wp-block-list > li', 'core/list-item' ), wp_get_state_selector_ancestor( '.wp-block-paragraph', 'core/paragraph' ) );
