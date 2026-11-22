<?php
// json or xml; anything else is json.
return array( wp_oembed_ensure_format( 'xml' ), wp_oembed_ensure_format( 'yaml' ) );
