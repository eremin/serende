<?php

namespace Eremin\SerEnDe\TypeHandlers\Encoder;

use Eremin\SerEnDe\Types\AbstractType;
use Eremin\SerEnDe\Types\StringType;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class StringHandler implements TypeHandlerInterface
{
    public function supports(AbstractType $type): bool
    {
        return $type instanceof StringType;
    }

    public function encodeType(AbstractType $type): string
    {
        return StringType::TYPE_LETTER . ":" . \strlen($type->rawContent) . ":\"{$type->rawContent}\";";
    }
}
