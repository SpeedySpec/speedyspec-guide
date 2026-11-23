<?php
// The contributors of a WordPress version from the Credits API, cached for a day, or false.
guide_queue_http( array( array( 'groups' => array( 'core-developers' => array( 'name' => 'Noteworthy Contributors', 'type' => 'titles', 'shuffle' => false, 'data' => array() ) ), 'data' => array( 'profiles' => 'https://profiles.wordpress.org/%s/', 'version' => '7.2' ) ) ) );
$credits = wp_credits( '7.2', 'en_US' );
return array_keys( $credits['groups'] );
