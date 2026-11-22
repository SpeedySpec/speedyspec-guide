<?php
// The settings controller: GET and POST /wp/v2/settings read and write the options registered with show_in_rest, each by its REST name and schema; null resets an option to its default.
register_setting( 'general', 'guide_tagline', array( 'type' => 'string', 'show_in_rest' => true, 'default' => 'plain' ) );
$before = guide_rest( 'GET', '/wp/v2/settings' )[1];
$after = guide_rest( 'POST', '/wp/v2/settings', array( 'title' => 'Renamed', 'guide_tagline' => 'fancy' ) )[1];
return array( $before['guide_tagline'], $after['title'], get_option( 'guide_tagline' ), guide_rest( 'POST', '/wp/v2/settings', array( 'guide_tagline' => null ) )[1]['guide_tagline'] );
