<?php
// Sends X-Frame-Options: SAMEORIGIN, so other sites can't frame the page; attached to the login and admin.
send_frame_options_header();
return has_action( 'login_init', 'send_frame_options_header' );
