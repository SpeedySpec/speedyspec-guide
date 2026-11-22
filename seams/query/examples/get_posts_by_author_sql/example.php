<?php
// The SQL WHERE clause for posts of types, optionally by an author and only public ones, with the private posts the user may read.
return array( get_posts_by_author_sql( 'post', true, 1 ), get_posts_by_author_sql( 'post', true, 1, true ) );
