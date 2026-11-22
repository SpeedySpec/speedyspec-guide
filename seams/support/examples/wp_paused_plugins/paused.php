<?php
// The storage of plugins paused by recovery mode, by plugin, for the current recovery session.
return array( get_class( wp_paused_plugins() ), wp_paused_plugins()->get_all() );
