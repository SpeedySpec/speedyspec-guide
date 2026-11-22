<?php
// The recovery mode service, made on first use.
return array( get_class( wp_recovery_mode() ), wp_recovery_mode() === wp_recovery_mode(), wp_recovery_mode()->is_active() );
