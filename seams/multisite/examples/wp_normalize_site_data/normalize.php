<?php
// Normalizes site data: the domain trimmed of spaces, the path with slashes around it, the network an ID, and flags as integers.
$data = wp_normalize_site_data( array( 'domain' => 'example.org ', 'path' => 'blog', 'network_id' => '1', 'public' => true) );
return array( $data['domain'], $data['path'], $data['network_id'], $data['public'] );
