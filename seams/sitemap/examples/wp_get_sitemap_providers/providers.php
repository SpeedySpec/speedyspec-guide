<?php
// The registered providers, by name: posts, taxonomies and users.
return array_map( 'get_class', wp_get_sitemap_providers() );
