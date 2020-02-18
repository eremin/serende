<?php

namespace Eremin\SerEnDe\TypeHandlers\Encoder;

use Eremin\SerEnDe\Types\AbstractType;

interface TypeHandlerInterface
{
    public function supports(AbstractType $type): bool;

    public function encodeType(AbstractType $type): string;
}
