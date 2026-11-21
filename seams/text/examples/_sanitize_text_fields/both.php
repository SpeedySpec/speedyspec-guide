<?php
// The shared cleaning, without and with newlines kept.
return array( _sanitize_text_fields( "a\nb" ), _sanitize_text_fields( "a\nb", true ), _sanitize_text_fields( new stdClass() ) );
