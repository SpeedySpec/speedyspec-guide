<?php
// The importers WordPress.org recommends (Blogger, LiveJournal, Movable Type, RSS, Tumblr, WordPress and others), from the API or a built-in list, cached for two days.
guide_queue_http( array() );
return array_keys( wp_get_popular_importers() );
