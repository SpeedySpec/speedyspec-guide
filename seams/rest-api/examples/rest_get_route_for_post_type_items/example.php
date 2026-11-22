<?php
// The REST route of a post type's collection; '' when the type isn't in REST.
register_post_type( 'book', array( 'show_in_rest' => true, 'rest_base' => 'books' ) );
register_post_type( 'secret', array( 'show_in_rest' => false ) );
return array( rest_get_route_for_post_type_items( 'post' ), rest_get_route_for_post_type_items( 'book' ), rest_get_route_for_post_type_items( 'secret' ) );
