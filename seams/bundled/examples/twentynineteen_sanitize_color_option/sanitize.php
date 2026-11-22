<?php
// The primary color choice, default or custom; anything else becomes default.
guide_theme( 'twentynineteen' );
return array( twentynineteen_sanitize_color_option( 'custom' ), twentynineteen_sanitize_color_option( 'blue' ) );
