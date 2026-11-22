<?php
// Whether a network has more than 10,000 sites or users (using sites or users); wp_is_large_network filters it.
return array( wp_is_large_network(), wp_is_large_network( 'users' ) );
