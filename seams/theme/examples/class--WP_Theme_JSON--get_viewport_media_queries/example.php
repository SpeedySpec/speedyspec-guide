<?php
// The media queries for responsive style states (@mobile, @tablet, and @desktop when asked) from settings.viewport's breakpoints, sanitized: only px, em and rem lengths, tablet dropped unless larger than mobile, and the defaults (480px and 782px) when none is valid.
return array( WP_Theme_JSON::get_viewport_media_queries( array( 'mobile' => '400px', 'tablet' => '60em' ) ), WP_Theme_JSON::get_viewport_media_queries( array( 'mobile' => '600px', 'tablet' => '500px' ), array( 'include_desktop' => true ) ), WP_Theme_JSON::get_viewport_media_queries( array( 'mobile' => 'calc(1px)' ) ) );
