<?php

namespace Eremin\SerEnDe;

use Eremin\SerEnDe\Types\AbstractType;

interface DecoderInternalInterface
{
    /**
     * @internal
     */
    public function decodeInternal(SerializedString $string): AbstractType;

    /**
     * @internal
     */
    public function decodeAndReferenceInternal(SerializedString $string): AbstractType;
}
