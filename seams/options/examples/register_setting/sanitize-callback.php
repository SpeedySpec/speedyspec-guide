<?php
// A sanitize_callback runs on the value whenever the option is saved.
register_setting( 'guide', 'guide_code', array( 'sanitize_callback' => 'strtoupper' ) );
update_option( 'guide_code', 'abc' );
return get_option( 'guide_code' );
