<?php

namespace Eremin\SerEnDe\TypeHandlers\Encoder;

use Eremin\SerEnDe\EncoderInternalInterface;
use Eremin\SerEnDe\Types\AbstractType;
use Eremin\SerEnDe\Types\ObjectType;
use Eremin\SerEnDe\Types\Properties\AbstractProperty;
use Eremin\SerEnDe\Types\Properties\PrivateProperty;
use Eremin\SerEnDe\Types\Properties\ProtectedProperty;
use Eremin\SerEnDe\Types\Properties\PublicProperty;
use Eremin\SerEnDe\Types\StringType;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class ObjectHandler implements TypeHandlerInterface, ComplexTypeHandler
{
    /**
     * @var EncoderInternalInterface
     */
    private $encoder;

    public function setEncoder(EncoderInternalInterface $encoder): void
    {
        $this->encoder = $encoder;
    }

    public function supports(AbstractType $type): bool
    {
        return $type instanceof ObjectType;
    }

    public function encodeType(AbstractType $type): string
    {
        if (!$type instanceof ObjectType) {
            throw new \LogicException('The type should be ObjectType');
        }

        $properties = $type->getProperties();
        $result = ObjectType::TYPE_LETTER . ':' . \strlen($type->className) . ":\"{$type->className}\":"
            . \count($properties) . ':{';
        foreach ($properties as $property) {
            $key = $this->createTypeForKey($property);
            $result .= $this->encoder->encodeInternal($key);
            $result .= $this->encoder->encodeAndReferenceInternal($property->getValue());
        }

        return $result . '}';
    }

    private function createTypeForKey(AbstractProperty $property): StringType
    {
        $type = new StringType();
        if ($property instanceof PublicProperty) {
            $type->rawContent = $property->propertyName;

            return $type;
        }
        if ($property instanceof ProtectedProperty) {
            $type->rawContent = "\000*\000{$property->propertyName}";

            return $type;
        }
        if ($property instanceof PrivateProperty) {
            $type->rawContent = "\000{$property->className}\000{$property->propertyName}";

            return $type;
        }

        throw new \LogicException('Unknown property type');
    }
}
