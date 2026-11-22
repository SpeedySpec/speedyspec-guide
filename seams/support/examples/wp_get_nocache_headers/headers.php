<?php
// The headers that stop caching: Expires in the past and Cache-Control no-cache, must-revalidate, max-age=0, no-store, private; nocache_headers filters them.
return wp_get_nocache_headers();
