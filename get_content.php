<?php

require "configure.php";

$environment = League\CommonMark\Environment::createCommonMarkEnvironment();
$environment->addExtension(new League\CommonMark\Extension\Autolink\AutolinkExtension());
$environment->addExtension(new League\CommonMark\Extension\TaskList\TaskListExtension());
$environment->addExtension(new League\CommonMark\Extension\Strikethrough\StrikethroughExtensionn());
$converter = new League\CommonMark\CommonMarkConverter([], $environment);

$folder = getenv("FOLDER");

$files = scandir($folder);

$pages = [];

foreach ($files as $name) {
    if ($name[0] == ".") { continue; }
    $content = file_get_contents("$folder/$name");
    if ($content) {
        $lines = explode("\n", $content);
        $first_line = $lines[0];
        $title = explode("# ", $first_line)[1];
        $last_line = "";
        while(empty($last_line)) {
            $last_line = array_pop($lines);
        }
        $tags = explode(",", explode("tags: ", $last_line)[1]); 
        $content = implode("\n", $lines);
        $html = $converter->convertToHtml($content);
        $pages[] = compact("name", "title", "content", "html", "tags");
    }
}

echo json_encode($pages);
