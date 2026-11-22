<?php
// Orders timezones for the timezone menu: by continent, then city, then subcity, Etc last; for usort.
$zones = array( array( 'continent' => 'Europe', 'city' => 'Paris', 'subcity' => '', 't_continent' => 'Europe', 't_city' => 'Paris', 't_subcity' => '' ), array( 'continent' => 'America', 'city' => 'Chicago', 'subcity' => '', 't_continent' => 'America', 't_city' => 'Chicago', 't_subcity' => '' ) );
usort( $zones, '_wp_timezone_choice_usort_callback' );
return wp_list_pluck( $zones, 'city' );
