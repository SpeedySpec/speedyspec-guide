<?php
// The installed plugins, by their main file relative to the plugins folder, each with its header data; cached.
return array_map( fn( $plugin ) => $plugin['Name'], get_plugins() );
