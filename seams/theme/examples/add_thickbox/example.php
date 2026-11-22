<?php
// Enqueues Thickbox's script and style, for its modal windows.
add_thickbox();
return array( wp_script_is( 'thickbox' ), wp_style_is( 'thickbox' ) );
