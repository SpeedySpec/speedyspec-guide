<?php
// Prints the News part of the Events and News widget from the WordPress news and Planet feeds: from the cache, or a loading note while they load after the page.
guide_queue_http( array() );
return str_contains( guide_render( 'wp_dashboard_primary' ), 'widget-loading' );
