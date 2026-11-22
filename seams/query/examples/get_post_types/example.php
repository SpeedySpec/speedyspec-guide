<?php
// The registered post types matching arguments, as names or objects.
return array( get_post_types( array( 'public' => true ) ), count( get_post_types() ) > 10 );
