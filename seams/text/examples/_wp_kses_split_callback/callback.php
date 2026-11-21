<?php
// The preg_replace_callback() callback wp_kses_split() uses, passing each match to wp_kses_split2().
global $pass_allowed_html, $pass_allowed_protocols;
$pass_allowed_html = array( 'b' => array() );
$pass_allowed_protocols = wp_allowed_protocols();
return _wp_kses_split_callback( array( '<b id="x">' ) );
