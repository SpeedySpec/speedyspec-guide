<?php
// Clears an inherited gradient when a state sets a solid background color.
return wp_get_state_declarations_with_background_resets( array( 'background-color' => 'red' ) );
