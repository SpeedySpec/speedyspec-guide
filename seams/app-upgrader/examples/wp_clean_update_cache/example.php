<?php
// Deletes the stored core, plugin and theme update answers and the plugins and themes caches, so the next check starts fresh.
guide_offer_core_update( '7.3' );
wp_clean_update_cache();
return get_site_transient( 'update_core' );
