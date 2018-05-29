<?php

$dir = __DIR__;

if ($dirHandler = opendir($dir)) {
    while (($content = readdir($dirHandler)) !== false){
        $contents[] = $content;
    }
    closedir($dirHandler);
}

sort($contents);

?>

<!doctype html>
<html>
    <head>
        <title>Contents of <?= $dir ?></title>
        <style>
            ul {
               list-style-type: none;
               margin: 0;
               padding: 0; 
            }
            a {
                text-decoration: none;
            }
            a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <ul>
            <?php foreach ($contents as $key => $content) : ?>
                <li key="<?= $key ?>">
                    <a href="<?= $content ?>"><?= $content ?></a>
                </li>
            <?php endforeach ?>            
        </ul>
    </body>
</html>
