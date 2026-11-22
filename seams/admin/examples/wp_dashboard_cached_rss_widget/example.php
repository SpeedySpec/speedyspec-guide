<?php
// Prints a feed widget from its cached output, or loads it after the page and caches it; gives whether it printed from the cache.
set_transient( 'dash_v2_' . md5( 'guide_feed_en_US' ), '<p>Cached news</p>', 60 );
$cached = false;
function guide_feed_output(): void
{
	echo '<p>Fresh news</p>';
}
$html = guide_render( function () use ( &$cached ) { $cached = wp_dashboard_cached_rss_widget( 'guide_feed', 'guide_feed_output' ); } );
return array( $cached, $html );
