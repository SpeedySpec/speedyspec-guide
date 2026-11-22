<?php
// Registers WordPress's default scripts: jQuery and its UI, the admin scripts, utils, heartbeat, media and more, with their localized data; sets the base URL and the default directories.
$s = wp_scripts();
return array( $s->base_url, $s->default_dirs, $s->registered['jquery']->deps, isset( $s->registered['heartbeat'] ) );
