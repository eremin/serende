<?php

namespace Eremin\SerEnDe\TypeHandlers\Decoder;

use Eremin\SerEnDe\ReferenceMap;
use Eremin\SerEnDe\SerializedString;
use Eremin\SerEnDe\Types\AbstractType;

interface TypeHandlerInterface
{
    public function getTypeChar(): string;

    public function parseType(SerializedString $string, ?ReferenceMap $referenceMap): AbstractType;
}
