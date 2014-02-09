<?php

\mb_internal_encoding('utf-8');

require_once 'vendor/autoload.php';

$parser = new \RedmineWikiParser\Parser;
$parser->open('input/newfile');
$parser->parse();
echo '<pre>';
//var_dump($parser->getLines());die;
print_r($parser->toAssocArray());