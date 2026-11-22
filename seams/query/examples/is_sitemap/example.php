<?php
// Whether the main query is for an XML sitemap.
guide_go( '/?sitemap=index' );
return is_sitemap();
