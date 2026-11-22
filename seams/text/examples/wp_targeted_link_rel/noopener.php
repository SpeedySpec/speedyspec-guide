<?php
// Adds rel="noopener" to links that open in a new window or tab.
return wp_targeted_link_rel( '<a href="https://x" target="_blank">x</a><a href="https://y">y</a>' );
