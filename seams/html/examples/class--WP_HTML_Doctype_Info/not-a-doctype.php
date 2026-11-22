<?php
// Anything that isn't a DOCTYPE token gives null.
return WP_HTML_Doctype_Info::from_doctype_token( '<p>' );
