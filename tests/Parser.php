<?php
/**
 * Copyright (c) 2014 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Licensed under the MIT license:
 * http://opensource.org/licenses/MIT
 */

namespace Icewind\DemoStore\Test;

use Icewind\DemoParser\Parser as DemoParser;

class Parser extends \PHPUnit_Framework_TestCase
{

    public function testParseSTV()
    {
        $parser = new DemoParser();
        $demo = $parser->parseFile(__DIR__ . '/stv.dem');
        $this->assertEquals('HL2DEMO', $demo->getType());
        $this->assertEquals(3, $demo->getVersion());
        $this->assertEquals(24, $demo->getProtocol());
        $this->assertEquals('UGC Highlander Match', $demo->getServer());
        $this->assertEquals('SourceTV Demo', $demo->getNick());
        $this->assertEquals('cp_gullywash_final1', $demo->getMap());
        $this->assertEquals('tf', $demo->getGame());
        $this->assertEquals(1942.7099609375, $demo->getDuration());
        $this->assertEquals(129514, $demo->getTicks());
        $this->assertEquals(30117, $demo->getFrames());
        $this->assertEquals(686833, $demo->getSigon());
    }

    /**
     * @expectedException \Icewind\DemoParser\InvalidDemoException
     */
    public function testParseInvalidFile()
    {
        $parser = new DemoParser();
        $parser->parseFile(__FILE__);
    }

    /**
     * @expectedException \Icewind\DemoParser\InvalidDemoException
     */
    public function testParseTruncatedFile()
    {
        $parser = new DemoParser();
        $parser->parseFile(__DIR__ . '/truncated.dem');
    }

    /**
     * @expectedException \Icewind\DemoParser\InvalidDemoException
     */
    public function testParseNonExistingFile()
    {
        $parser = new DemoParser();
        $parser->parseFile(__DIR__ . '/non_existing.dem');
    }
}
