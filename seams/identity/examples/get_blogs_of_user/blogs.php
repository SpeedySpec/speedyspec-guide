<?php
// The sites a user belongs to, by ID, with their name and URLs; on a single site, this site for any existing user.
$grace = guide_user();
$sites = get_blogs_of_user( $grace );
return array( array_keys( $sites ), $sites[1]->blogname, $sites[1]->siteurl, get_blogs_of_user( 999 ) );
