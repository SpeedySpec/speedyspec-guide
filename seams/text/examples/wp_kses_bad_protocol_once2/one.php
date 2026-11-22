<?php
// Checks one protocol name against the allowed ones, and returns it with its colon, or nothing.
return array( wp_kses_bad_protocol_once2( 'https', array( 'https' ) ), wp_kses_bad_protocol_once2( 'javascript', array( 'https' ) ) );
