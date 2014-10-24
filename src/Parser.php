<?php
/**
 * Copyright (c) 2014 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Licensed under the MIT license:
 * http://opensource.org/licenses/MIT
 */

namespace Icewind\DemoParser;

class Parser
{
    function errorHandler($code, $message)
    {
        throw new InvalidDemoException($message, $code);
    }

    /**
     * @param string $head string containing the demo header binary data
     * @return \Icewind\DemoParser\DemoInfo
     * @throws \Icewind\DemoParser\InvalidDemoException
     */
    public function parseString($head)
    {
        set_error_handler(array($this, 'errorHandler'));
        $info = unpack("A8type/Iversion/Iprotocol/A260server/A260nick/A260map/A260game/fduration/Iticks/Iframes/Isigon",
            $head);
        restore_error_handler();
        if ($info['type'] !== 'HL2DEMO') {
            throw new InvalidDemoException('Not an HL2 demo');
        }
        return new DemoInfo($info);
    }

    /**
     * Parse demo info from a stream
     *
     * @param resource $stream
     * @return \Icewind\DemoParser\DemoInfo
     * @throws \Icewind\DemoParser\InvalidDemoException
     */
    public function parseStream($stream)
    {
        $head = fread($stream, 2048);
        return $this->parseString($head);
    }

    /**
     * Parse demo info from a local file
     *
     * @param string $path
     * @return \Icewind\DemoParser\DemoInfo
     * @throws \Icewind\DemoParser\InvalidDemoException
     */
    public function parseFile($path)
    {
        if (!is_readable($path)) {
            throw new InvalidDemoException('Unable to open demo: ' . $path);
        }
        $fh = fopen($path, 'rb');
        return $this->parseStream($fh);
    }
}
