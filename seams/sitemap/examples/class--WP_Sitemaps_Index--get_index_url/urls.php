<?php
// /?sitemap=index with plain permalinks, /wp-sitemap.xml with pretty ones.
$index = new WP_Sitemaps_Index( new WP_Sitemaps_Registry() );
$plain = $index->get_index_url();
guide_pretty_permalinks();
return array( $plain, $index->get_index_url() );
