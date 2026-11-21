<?php
// With kses in another operating mode than legacy, the text is returned as it is.
$GLOBALS['wp_kses_operating_mode'] = 'html-api';
return wp_pre_kses_less_than( 'a < b' );
