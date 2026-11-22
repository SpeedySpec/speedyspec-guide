<?php
// Hooked to template_redirect: sends a Link header to the REST API's root, plus the queried resource's route; does nothing once headers are sent.
return array( rest_output_link_header(), has_action( 'template_redirect', 'rest_output_link_header' ) );
