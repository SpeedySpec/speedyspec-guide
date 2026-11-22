<?php
// wp_kses_post() on every string in an array or object.
return wp_kses_post_deep( array( 'a' => '<b>ok</b><script></script>', 'b' => array( '<i>x</i>' ) ) );
