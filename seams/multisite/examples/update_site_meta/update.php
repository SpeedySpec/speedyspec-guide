<?php
// Sets a site's meta, adding it when missing, or only the rows with an old value.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
update_site_meta( $site, 'color', 'blue' );
update_site_meta( $site, 'color', 'green', 'blue' );
return get_site_meta( $site, 'color', true );
