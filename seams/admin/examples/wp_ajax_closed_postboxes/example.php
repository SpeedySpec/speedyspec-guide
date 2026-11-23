<?php
// Ajax handler that remembers which boxes a user collapsed or hid on a screen, in their user options.
guide_ajax( 'wp_ajax_closed_postboxes', array( 'page' => 'post', 'closed' => 'postcustom,commentsdiv', 'hidden' => 'slugdiv', 'closedpostboxesnonce' => wp_create_nonce( 'closedpostboxes' ) ) );
return array( get_user_option( 'closedpostboxes_post' ), get_user_option( 'metaboxhidden_post' ) );
