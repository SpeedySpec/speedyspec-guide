<?php
add_filter( 'x', fn( $v ) => $v . '!' );
return apply_filters( 'x', 'a' );
