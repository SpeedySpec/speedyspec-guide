<?php
// Whether the locale is right-to-left, from the locale object's text direction.
$ltr = is_rtl();
$GLOBALS['wp_locale']->text_direction = 'rtl';
return array( $ltr, is_rtl() );
