<?php
// Void elements never have content or a closer.
return array( WP_HTML_Processor::is_void( 'br' ), WP_HTML_Processor::is_void( 'IMG' ), WP_HTML_Processor::is_void( 'div' ) );
