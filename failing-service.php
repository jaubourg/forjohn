<?php

sleep(rand(10,20));

header("Content-type: application/javascript; charset=UTF-8");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("HTTP/1.0 400 Internal Server Error");

?>