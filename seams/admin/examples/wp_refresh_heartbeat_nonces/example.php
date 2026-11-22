<?php
// Hooked to wp_refresh_nonces: sends fresh REST API and Heartbeat nonces.
return array_keys( wp_refresh_heartbeat_nonces( array() ) );
