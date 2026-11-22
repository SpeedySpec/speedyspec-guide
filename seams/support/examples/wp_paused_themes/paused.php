<?php
// The storage of themes paused by recovery mode, by theme, for the current recovery session.
return array( get_class( wp_paused_themes() ), wp_paused_themes()->get_all() );
