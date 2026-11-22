<?php
// wp_plugin_dependencies_slug can change each slug, such as mapping a premium plugin to its free one; invalid slugs are dropped.
add_filter( 'wp_plugin_dependencies_slug', fn( $slug ) => 'pro-forms' === $slug ? 'forms' : $slug );
return guide_call( 'WP_Plugin_Dependencies', 'sanitize_dependency_slugs', ' zeta, pro-forms , Bad_Slug, alpha,zeta,, -x' );
