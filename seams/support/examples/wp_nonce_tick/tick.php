<?php
// The current nonce tick: time divided by half the nonce life (a day by default, filtered by nonce_life), rounded up.
return wp_nonce_tick() == ceil( time() / ( DAY_IN_SECONDS / 2 ) );
