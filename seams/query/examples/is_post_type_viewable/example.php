<?php
// Whether a post type is viewable on the front end: publicly queryable, or built in and public; filtered by is_post_type_viewable.
register_post_type( 'secret', array( 'public' => false ) );
return array( is_post_type_viewable( 'post' ), is_post_type_viewable( 'page' ), is_post_type_viewable( 'secret' ) );
