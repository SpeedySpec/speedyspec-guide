<?php
// A plugin has unmet dependencies when one isn't installed or isn't active; has_active_dependents() says whether an active plugin needs this one.
WP_Plugin_Dependencies::initialize();
return array( WP_Plugin_Dependencies::has_unmet_dependencies( 'shop/shop.php' ), WP_Plugin_Dependencies::has_unmet_dependencies( 'reports/reports.php' ), WP_Plugin_Dependencies::has_unmet_dependencies( 'payments/payments.php' ), WP_Plugin_Dependencies::has_active_dependents( 'payments/payments.php' ), WP_Plugin_Dependencies::has_active_dependents( 'pong/pong.php' ) );
