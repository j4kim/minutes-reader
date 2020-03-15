<?php

require "configure.php";

$folder = getenv("FOLDER");

$output = [];
exec("git -C $folder pull origin master", $output);

$logfile = "log.txt";
$logcontent =
  date("Y-m-d H:i:s") .
  "\ngit pull output:\n" .
  @json_encode($output, JSON_PRETTY_PRINT) . "\n\n";
file_put_contents($logfile, $logcontent, FILE_APPEND);
