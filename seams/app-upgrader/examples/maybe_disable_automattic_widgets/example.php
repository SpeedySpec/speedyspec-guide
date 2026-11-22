<?php
// Deactivates the Automattic Widgets plugin, merged into WordPress 2.2, when it is active.
update_option( 'active_plugins', array( 'widgets/widgets.php', 'hello.php' ) );
maybe_disable_automattic_widgets();
return get_option( 'active_plugins' );
