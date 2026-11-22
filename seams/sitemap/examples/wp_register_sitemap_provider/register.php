<?php
// Adds a provider by name; a name already taken is refused.
class Guide_Sitemap extends WP_Sitemaps_Provider {
	public function __construct() { $this->name = 'guide'; $this->object_type = 'guide'; }
	public function get_url_list( $page_num, $object_subtype = '' ) { return array( array( 'loc' => 'http://example.org/a' ) ); }
	public function get_max_num_pages( $object_subtype = '' ) { return 1; }
}
return array( wp_register_sitemap_provider( 'guide', new Guide_Sitemap() ), wp_register_sitemap_provider( 'guide', new Guide_Sitemap() ), get_sitemap_url( 'guide' ) );
