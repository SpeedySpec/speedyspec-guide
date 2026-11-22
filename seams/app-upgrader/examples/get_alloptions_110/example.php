<?php
// All options as name and value, read straight from the table as WordPress 1.2 did, for old upgrade routines.
$options = get_alloptions_110();
return array( $options->blogname, isset( $options->siteurl ) );
