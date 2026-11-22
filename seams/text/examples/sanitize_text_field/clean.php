<?php
// Strips tags, collapses whitespace and line breaks, removes percent-encoded octets, and keeps a lone <.
return array( sanitize_text_field( " <b>a</b>\n b %20c < d " ), sanitize_text_field( array( 'x' ) ) );
