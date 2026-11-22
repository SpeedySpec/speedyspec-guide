<?php
// The Navigation Link block's variations, one per post type and taxonomy.
return wp_list_pluck( block_core_navigation_link_build_variations(), 'name' );
