DemoParser
==========

[![Build Status](https://travis-ci.org/icewind1991/demoparser.svg)](https://travis-ci.org/icewind1991/demoparser)

Parser for HL2 demo files

Usage
---
```php
$parser = new Icewind\DemoParser\Parser();
$info = $parser->parseFile('my_demo_file.dem');

echo 'Player: ' . $info->getNick() . "\n";
echo 'Map: ' . $info->getMap() . "\n";
echo 'Duration: ' . floor($info->getDuration()) . " seconds \n";
```

