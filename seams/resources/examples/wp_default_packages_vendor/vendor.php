<?php
// Registers the third-party scripts the packages use (React, ReactDOM, lodash, moment, regenerator-runtime and polyfills), with their versions; moment gets the site's locale settings.
$s = wp_scripts();
return array_values( array_intersect( array( 'react', 'react-dom', 'lodash', 'moment', 'regenerator-runtime', 'wp-polyfill' ), array_keys( $s->registered ) ) );
