<?php
// A site's ID by its name (subdomain or path), or null.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
return array( get_id_from_blogname( 'second' ), get_id_from_blogname( 'nope' ) );
