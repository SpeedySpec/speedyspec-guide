<?php
// Turns var:preset|... references into CSS variables, recursively, since state styles are emitted as rules.
return wp_normalize_state_preset_vars( array( 'color' => array( 'text' => 'var:preset|color|contrast' ) ) );
