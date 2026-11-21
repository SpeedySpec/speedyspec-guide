<?php
// An action callback is a filter callback: add_action() calls add_filter().
add_action( 'guide_value', fn( $v ) => $v . '!' );

return apply_filters( 'guide_value', 'a' );
