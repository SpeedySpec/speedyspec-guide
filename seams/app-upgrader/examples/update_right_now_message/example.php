<?php
// Prints the At a Glance widget's line naming the WordPress version and theme, with an update button when one is offered.
guide_offer_core_update( '7.3' );
// The WordPress version is shown as <version>, so the result stays the same between releases.
return str_replace( get_bloginfo( 'version' ), '<version>', wp_strip_all_tags( guide_render( 'update_right_now_message' ) ) );
