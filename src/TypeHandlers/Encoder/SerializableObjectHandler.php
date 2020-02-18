<?php

namespace Eremin\SerEnDe\TypeHandlers\Encoder;

use Eremin\SerEnDe\Types\AbstractType;
use Eremin\SerEnDe\Types\SerializableObjectType;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class SerializableObjectHandler implements TypeHandlerInterface
{
    public function supports(AbstractType $type): bool
    {
        return $type instanceof SerializableObjectType;
    }

    public function encodeType(AbstractType $type): string
    {
        if (!$type instanceof SerializableObjectType) {
            throw new \LogicException('The argument should be of class ' . SerializableObjectType::class);
        }

        return SerializableObjectType::TYPE_LETTER . ":" . \strlen($type->className) . ":\"{$type->className}\":"
            . \strlen($type->rawContent) . ":{{$type->rawContent}}";
    }
}
