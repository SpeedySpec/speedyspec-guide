<?php
// One pass of protocol removal; wp_kses_bad_protocol() repeats it until nothing changes.
return wp_kses_bad_protocol_once( 'javascript:javascript:x', array( 'https' ) );
