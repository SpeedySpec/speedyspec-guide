<?php
// Reads a JSON file into an array, cached per path; an empty array when it can't be read or parsed.
$read = Closure::bind( fn( $file ) => static::read_json_file( $file ), null, WP_Theme_JSON_Resolver::class );
return array( $read( get_theme_root() . '/twentytwentyfive/theme.json' )['version'], $read( '/no/file.json' ) );
