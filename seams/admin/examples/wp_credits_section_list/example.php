<?php
// Prints a credits group's people: names with their profile links and roles, or plain names for long lists.
guide_queue_http( array( array( 'groups' => array( 'core-developers' => array( 'name' => 'Noteworthy Contributors', 'type' => 'compact', 'shuffle' => false, 'data' => array( array( 'Ada Lovelace', '', 'ada', 'Core' ) ) ) ), 'data' => array( 'profiles' => 'https://profiles.wordpress.org/%s/', 'version' => '7.2' ) ) ) );
$credits = wp_credits( '7.2', 'en_US' );
return str_contains( guide_render( fn() => wp_credits_section_list( $credits, 'core-developers' ) ), 'Ada Lovelace' );
