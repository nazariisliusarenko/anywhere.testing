<?php
$timestamp = time();
$date_time = date("d-m-Y (D) H:i:s", $timestamp);
echo "Current date and local time on this server is $date_time";
exit;
