<?php
// The inline script making the Archives block's dropdown go to the chosen archive.
$script = block_core_archives_build_dropdown_script( 'wp-block-archives-1' );
return str_contains( $script, 'wp-block-archives-1' );
