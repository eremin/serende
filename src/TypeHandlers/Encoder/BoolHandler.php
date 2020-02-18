<?php

namespace Eremin\SerEnDe\TypeHandlers\Encoder;

use Eremin\SerEnDe\Types\AbstractType;
use Eremin\SerEnDe\Types\BoolType;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class BoolHandler implements TypeHandlerInterface
{
    public function supports(AbstractType $type): bool
    {
        return $type instanceof BoolType;
    }

    public function encodeType(AbstractType $type): string
    {
        return BoolType::TYPE_LETTER . ":{$type->rawContent};";
    }
}
