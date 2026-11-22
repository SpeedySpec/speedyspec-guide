<?php
// The small set of tags allowed in comments and other untrusted data.
return wp_kses_data( '<b>bold</b><img src="x"><a href="https://example.org" title="t">link</a>' );
