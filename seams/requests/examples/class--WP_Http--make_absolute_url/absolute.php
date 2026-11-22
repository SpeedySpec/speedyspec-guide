<?php
// Resolves a URL against a base, removing . and .. segments; parse_url() is wp_parse_url().
return array( WP_Http::make_absolute_url( '../c?d', 'http://example.org/a/b/' ), WP_Http::make_absolute_url( '/root', 'http://example.org/a/b' ), WP_Http::make_absolute_url( '//cdn.example/x', 'https://example.org/' ), WP_Http::make_absolute_url( 'https://other/', 'http://example.org/' ), WP_Http::make_absolute_url( '?q=1', 'http://example.org/page' ) );
