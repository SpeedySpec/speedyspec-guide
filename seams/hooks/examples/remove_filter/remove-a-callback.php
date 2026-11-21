<?php
// Remove a callback; it reports whether it removed one.
add_filter( 'guide_up', 'strtoupper' );
$removed = remove_filter( 'guide_up', 'strtoupper' );

return array( $removed, apply_filters( 'guide_up', 'a' ) );
