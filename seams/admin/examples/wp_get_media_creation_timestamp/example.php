<?php
// The time a video was recorded, from the creation date getID3 read, or false.
return array( wp_get_media_creation_timestamp( array( 'fileformat' => 'mp4', 'quicktime' => array( 'moov' => array( 'subatoms' => array( array( 'creation_time_unix' => 1773568800 ) ) ) ) ) ), wp_get_media_creation_timestamp( array() ) );
