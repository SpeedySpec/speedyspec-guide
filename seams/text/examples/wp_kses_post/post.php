<?php
// The tags and attributes allowed in post content. The HTML API writes the attributes it keeps afresh.
return wp_kses_post( '<p style="color:red"><iframe src="x"></iframe><img src="a.png" alt="A" onerror="bad()"></p>' );
