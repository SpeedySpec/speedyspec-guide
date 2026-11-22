<?php
// Makes relative url() references in inlined CSS relative to the site, from the stylesheet's URL; absolute, data and anchor URLs are left alone.
return _wp_normalize_relative_css_links( '.a{background:url(img/a.png)} .b{background:url(https://x/b.png)} .c{background:url(data:image/png;base64,AA)}', 'http://example.org/wp-content/themes/t/style.css' );
