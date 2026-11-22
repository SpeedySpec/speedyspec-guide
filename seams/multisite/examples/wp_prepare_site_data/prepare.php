<?php
// A site's data for inserting or updating: merged with the old data and defaults, its options set aside, normalized, validated and given the database's column names (site_id for the network); an error when invalid.
$data = wp_prepare_site_data( array( 'domain' => 'example.org', 'path' => 'third' ), array( 'network_id' => 1, 'registered' => '2026-03-01 09:00:00', 'last_updated' => '2026-03-01 09:00:00', 'public' => 1, 'archived' => 0, 'mature' => 0, 'spam' => 0, 'deleted' => 0, 'lang_id' => 0 ) );
return array( $data['path'], $data['site_id'], wp_prepare_site_data( array( 'domain' => '' ), array() ) instanceof WP_Error );
