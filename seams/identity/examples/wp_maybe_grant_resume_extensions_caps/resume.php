<?php
// On user_has_cap: grants resume_plugin and resume_theme to users who can edit plugins or switch themes.
return array( wp_maybe_grant_resume_extensions_caps( array( 'activate_plugins' => true ) ), wp_maybe_grant_resume_extensions_caps( array( 'switch_themes' => true ) ), wp_maybe_grant_resume_extensions_caps( array() ) );
