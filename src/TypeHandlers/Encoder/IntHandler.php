<?php

namespace Eremin\SerEnDe\TypeHandlers\Encoder;

use Eremin\SerEnDe\Types\AbstractType;
use Eremin\SerEnDe\Types\IntType;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class IntHandler implements TypeHandlerInterface
{
    public function supports(AbstractType $type): bool
    {
        return $type instanceof IntType;
    }

    public function encodeType(AbstractType $type): string
    {
        return IntType::TYPE_LETTER . ":{$type->rawContent};";
    }
}
