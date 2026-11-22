<?php
// Prints the At a Glance widget's line naming the WordPress version and theme, with an update button when one is offered.
guide_offer_core_update( '7.3' );
return wp_strip_all_tags( guide_render( 'update_right_now_message' ) );
