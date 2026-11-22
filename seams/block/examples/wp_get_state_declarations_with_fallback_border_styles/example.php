<?php
// Adds border-style: solid to declarations with a border width or color but no style, so the border shows.
return wp_get_state_declarations_with_fallback_border_styles( array( 'border-width' => '2px' ) );
