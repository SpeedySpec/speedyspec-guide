<?php
// A network's WP_Network by ID or object (the current one by default), or null; get_network filters it.
return array( get_network()->domain, get_network( 1 )->site_name, get_network( 99 ) );
