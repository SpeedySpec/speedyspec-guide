<?php
// The allowed elements for a context: post, data, strip, entities, or a custom list.
return array( isset( wp_kses_allowed_html( 'post' )['iframe'] ), isset( wp_kses_allowed_html( 'post' )['img'] ), array_keys( wp_kses_allowed_html( 'data' ) ) === array_keys( $GLOBALS['allowedtags'] ), wp_kses_allowed_html( 'strip' ) );
