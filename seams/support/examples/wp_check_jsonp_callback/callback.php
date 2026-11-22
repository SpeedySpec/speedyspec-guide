<?php
// Whether a JSONP callback name is safe: only letters, digits, underscores and dots.
return array( wp_check_jsonp_callback( 'jQuery.cb_1' ), wp_check_jsonp_callback( 'alert(1)' ), wp_check_jsonp_callback( array() ) );
