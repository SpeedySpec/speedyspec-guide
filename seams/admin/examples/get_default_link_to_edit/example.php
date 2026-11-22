<?php
// A new link with default values for the form, filled from the request when given.
$_GET['linkurl'] = 'https://example.org/';
$link = get_default_link_to_edit();
return array( $link->link_url, $link->link_visible );
