<?php
// Hooked to transition_post_status: publishes a Customizer changeset when its post becomes published, applying its settings.
return has_action( 'transition_post_status', '_wp_customize_publish_changeset' );
