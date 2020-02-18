<?php

namespace Eremin\SerEnDe\TypeHandlers\Encoder;

use Eremin\SerEnDe\EncoderInternalInterface;

interface ComplexTypeHandler
{
    public function setEncoder(EncoderInternalInterface $decoder);
}
