<?php
// A site detail, as get_bloginfo() names it, with its characters escaped for a feed; filtered by get_bloginfo_rss.
update_option( 'blogname', 'Tea & <b>Biscuits</b>' );
return array( get_bloginfo_rss( 'name' ), get_bloginfo_rss( 'url' ) );
