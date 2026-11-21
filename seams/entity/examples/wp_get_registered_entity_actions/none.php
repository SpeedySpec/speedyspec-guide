<?php
// An entity with no registered actions has an empty list.
do_action( 'init' );
return wp_get_registered_entity_actions( 'postType', 'book' );
