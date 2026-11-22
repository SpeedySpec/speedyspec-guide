<?php
// The SQL condition limiting posts of a type to those the user may see: published, plus private ones they can read.
return get_private_posts_cap_sql( 'post' );
