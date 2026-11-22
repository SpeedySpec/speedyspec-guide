<?php
// Sends a request on an uninstalled site to the installer; on multisite it stops with an error instead. Nothing on an installed site.
wp_not_installed();
return 'installed';
