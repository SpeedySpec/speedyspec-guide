<?php
// Adds the fallback styles aspect ratio and height need in a state, as the block library's inline rules do.
return wp_get_state_style_with_fallback_dimension_styles( array( 'dimensions' => array( 'aspectRatio' => '1' ) ) );
