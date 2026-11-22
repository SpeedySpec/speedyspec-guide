<?php
// A registered post type's object, or null.
return array( get_post_type_object( 'page' )->labels->singular_name, get_post_type_object( 'nope' ) );
