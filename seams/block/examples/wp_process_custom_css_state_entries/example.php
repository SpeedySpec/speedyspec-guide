<?php
// Turns a block's custom CSS entries into CSS under a selector, dropping entries that close style tags.
return wp_process_custom_css_state_entries( array( array( 'css' => 'color: red;', 'state' => '', 'media' => '' ) ), '.guide-1' );
