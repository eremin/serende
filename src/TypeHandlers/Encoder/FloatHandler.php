<?php

namespace Eremin\SerEnDe\TypeHandlers\Encoder;

use Eremin\SerEnDe\Types\AbstractType;
use Eremin\SerEnDe\Types\FloatType;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class FloatHandler implements TypeHandlerInterface
{
    public function supports(AbstractType $type): bool
    {
        return $type instanceof FloatType;
    }

    public function encodeType(AbstractType $type): string
    {
        return FloatType::TYPE_LETTER . ":{$type->rawContent};";
    }
}
