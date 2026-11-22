<?php
// Names for display: a dependency's name from the plugin directory when known (only on the plugins screens), else the installed plugin's name, else its slug; dependents by name, sorted. Outside those screens no API data is read.
WP_Plugin_Dependencies::initialize();
return array( WP_Plugin_Dependencies::get_dependency_names( 'shop/shop.php' ), WP_Plugin_Dependencies::get_dependency_names( 'reports/reports.php' ), WP_Plugin_Dependencies::get_dependent_names( 'payments/payments.php' ), WP_Plugin_Dependencies::get_dependency_data( 'payments' ) );
