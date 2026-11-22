<?php
// The title of the tag archive queried.
wp_insert_term( 'Red', 'post_tag' );
guide_go( '/?tag=red' );
return single_tag_title( '', false );
