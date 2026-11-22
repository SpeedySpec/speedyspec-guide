<?php
// Whether the HTTPS check found no errors.
guide_queue_http( "HTTP/1.1 200 OK\r\n\r\n<html></html>" );
return wp_is_https_supported();
