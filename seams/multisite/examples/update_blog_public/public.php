<?php
// Updates the site's public flag when its blog_public option changes; on update_option_blog_public.
update_blog_public( 1, 0 );
return get_site()->public;
