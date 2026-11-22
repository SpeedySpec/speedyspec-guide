<?php
// Downloads a URL to a temporary file and gives its path, or an error; checks the signature when asked.
guide_queue_http( array( 'file contents' ) );
$file = download_url( 'https://example.org/plugin.zip' );
$is_temp = str_starts_with( $file, get_temp_dir() );
unlink( $file );
return $is_temp;
