<?php
// Whether a media type is JSON: application/json or any type ending in +json.
return array( wp_is_json_media_type( 'application/json' ), wp_is_json_media_type( 'application/ld+json; charset=UTF-8' ), wp_is_json_media_type( 'text/html' ) );
