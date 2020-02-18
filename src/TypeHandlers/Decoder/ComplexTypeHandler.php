<?php

namespace Eremin\SerEnDe\TypeHandlers\Decoder;

use Eremin\SerEnDe\DecoderInternalInterface;

interface ComplexTypeHandler
{
    public function setDecoder(DecoderInternalInterface $decoder): void;
}
