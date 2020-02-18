<?php

namespace Eremin\SerEnDe\TypeHandlers\Encoder;

use Eremin\SerEnDe\Types\AbstractType;
use Eremin\SerEnDe\Types\NullType;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class NullHandler implements TypeHandlerInterface
{
    public function supports(AbstractType $type): bool
    {
        return $type instanceof NullType;
    }

    public function encodeType(AbstractType $type): string
    {
        return NullType::TYPE_LETTER . ';';
    }
}
