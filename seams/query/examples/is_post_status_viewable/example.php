<?php
// Whether a post status is viewable: public and not internal; filtered by is_post_status_viewable.
return array( is_post_status_viewable( 'publish' ), is_post_status_viewable( 'private' ), is_post_status_viewable( 'draft' ) );
