<?php
// Whether HTML came from this site, by the RSD or REST API link in its head; null when neither is hooked to wp_head.
return wp_is_local_html_output( '<html></html>' );
