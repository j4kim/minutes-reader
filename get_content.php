<?php

require "configure.php";

$environment = League\CommonMark\Environment::createCommonMarkEnvironment();
$environment->addExtension(new League\CommonMark\Extension\Autolink\AutolinkExtension());
$environment->addExtension(new League\CommonMark\Extension\TaskList\TaskListExtension());
$converter = new League\CommonMark\CommonMarkConverter([], $environment);

$folder = getenv("FOLDER");

$files = scandir($folder);

$pages = [];

foreach ($files as $name) {
    $content = file_get_contents("$folder/$name");
    if($content){
        $lines = explode("\n", $content);
        $first_line = $lines[0];
        $title = array_pop(explode("# ", $first_line));
        $last_line = array_pop($lines);
        $tags = explode(",", array_pop(explode("tags: ", $last_line))); 
        $content = implode("\n", $lines);
        $html = $converter->convertToHtml($content);
        $pages[] = compact("name", "title", "content", "html", "tags");
    }
}

echo json_encode($pages);