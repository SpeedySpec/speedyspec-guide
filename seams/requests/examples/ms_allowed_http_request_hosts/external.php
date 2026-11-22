<?php
// A host already external stays allowed; others are checked against the network's domain and sites.
return ms_allowed_http_request_hosts( true, 'anything' );
