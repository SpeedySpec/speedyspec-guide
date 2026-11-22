<?php
// The REST route of a taxonomy's collection; '' when it isn't in REST.
return array( rest_get_route_for_taxonomy_items( 'category' ), rest_get_route_for_taxonomy_items( 'post_tag' ), rest_get_route_for_taxonomy_items( 'nav_menu' ) );
