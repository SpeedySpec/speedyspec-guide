<?php
// Pings the update services (ping_sites) with the site's name and URL through XML-RPC; nothing when the site isn't public.
update_option( 'blog_public', 0 );
return generic_ping( 0 );
