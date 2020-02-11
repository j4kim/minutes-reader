<?php

require "vendor/autoload.php";

$config = Dotenv\Dotenv::createImmutable(__DIR__);
$config->load();
$config->required(["FOLDER"]);