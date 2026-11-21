<?php
// Remove every callback on an action.
add_action( 'guide_act', 'strtoupper' );
add_action( 'guide_act', 'trim', 5 );
remove_all_actions( 'guide_act' );

return has_action( 'guide_act' );
