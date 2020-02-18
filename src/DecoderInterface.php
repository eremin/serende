<?php

namespace Eremin\SerEnDe;

use Eremin\SerEnDe\Types\AbstractType;

interface DecoderInterface
{
    public function decodeFromString(string $serialized): AbstractType;

    /**
     * @param resource $stream
     */
    public function decodeFromStream($stream): AbstractType;
}
