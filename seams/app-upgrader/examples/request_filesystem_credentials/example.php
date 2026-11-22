<?php
// Gives the FTP or SSH credentials to connect with, from the request, constants and the saved ftp_credentials option, or prints the credentials form and gives false; true for the direct method.
return request_filesystem_credentials( admin_url( 'update-core.php' ) );
