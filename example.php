<?php

require_once 'vendor/autoload.php';

$parser = new Icewind\DemoParser\Parser();
$info = $parser->parseFile('tests/stv.dem');

echo 'Player: ' . $info->getNick() . "\n";
echo 'Map: ' . $info->getMap() . "\n";
echo 'Duration: ' . floor($info->getDuration()) . " seconds \n";
