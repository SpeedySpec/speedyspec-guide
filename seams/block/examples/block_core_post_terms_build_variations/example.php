<?php
// The Post Terms block's variations, one per taxonomy shown in REST.
return wp_list_pluck( block_core_post_terms_build_variations(), 'name' );
