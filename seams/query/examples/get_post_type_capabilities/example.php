<?php
// A post type's capabilities, from its capability_type and capabilities, as an object; with map_meta_cap, its meta capabilities are mapped.
return (array) get_post_type_capabilities( (object) array( 'capability_type' => 'book', 'capabilities' => array(), 'map_meta_cap' => true ) );
