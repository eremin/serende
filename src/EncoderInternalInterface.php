<?php

namespace Eremin\SerEnDe;

use Eremin\SerEnDe\Types\AbstractType;

interface EncoderInternalInterface
{
    public function encodeInternal(AbstractType $type): string;

    public function encodeAndReferenceInternal(AbstractType $type): string;
}
