<?php
// On a single embeddable post, prints the oEmbed discovery links (JSON and XML); oembed_discovery_links filters them.
guide_view( guide_post() );
return guide_render( 'wp_oembed_add_discovery_links' );
