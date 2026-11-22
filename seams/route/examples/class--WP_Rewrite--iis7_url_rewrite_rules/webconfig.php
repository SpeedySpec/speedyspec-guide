<?php
// The web.config rule for IIS, optionally wrapped in configuration tags; iis7_url_rewrite_rules filters it.
$r = guide_permalinks( '/%postname%/' );
return $r->iis7_url_rewrite_rules();
