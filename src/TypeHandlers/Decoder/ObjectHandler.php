<?php

namespace Eremin\SerEnDe\TypeHandlers\Decoder;

use Eremin\SerEnDe\DecoderInternalInterface;
use Eremin\SerEnDe\ReferenceMap;
use Eremin\SerEnDe\SerializedString;
use Eremin\SerEnDe\Types\AbstractType;
use Eremin\SerEnDe\Types\ObjectType;
use Eremin\SerEnDe\Types\Properties\PrivateProperty;
use Eremin\SerEnDe\Types\Properties\ProtectedProperty;
use Eremin\SerEnDe\Types\Properties\PublicProperty;

class ObjectHandler implements TypeHandlerInterface, ComplexTypeHandler
{
    /**
     * @var DecoderInternalInterface
     */
    private $decoder;

    public function setDecoder(DecoderInternalInterface $decoder): void
    {
        $this->decoder = $decoder;
    }

    public function getTypeChar(): string
    {
        return ObjectType::TYPE_LETTER;
    }

    public function parseType(SerializedString $string, ?ReferenceMap $referenceMap): AbstractType
    {
        $string->assertNextOne(':');
        $classNameLength = (int)$string->readUntil(':');
        $string->assertNextOne('"');
        $className = $string->readByLength($classNameLength);
        $string->assertNextOne('"');
        $string->assertNextOne(':');
        $length = (int)$string->readUntil(':');
        $string->assertNextOne('{');

        $type = ObjectType::createReferenced($referenceMap);
        $type->className = $className;
        for ($counter = 0; $counter < $length; ++$counter) {
            $key = $this->decoder->decodeInternal($string);
            $value = $this->decoder->decodeAndReferenceInternal($string);
            $property = $this->createProperty($key->rawContent);
            $property->setValue($value);
            $type->addProperty($property);
        }
        $string->assertNextOne('}');

        return $type;
    }

    private function createProperty(string $key)
    {
        if ("\000" !== $key[0]) {
            $publicProperty = new PublicProperty();
            $publicProperty->propertyName = $key;

            return $publicProperty;
        }
        if ("\000*\000" === \substr($key, 0, 3)) {
            $protectedProperty = new ProtectedProperty();
            $protectedProperty->propertyName = \substr($key, 3);

            return $protectedProperty;
        }

        $nullPos = \strpos($key, "\000", 1);
        $privateProperty = new PrivateProperty();
        $privateProperty->propertyName = \substr($key, $nullPos + 1);
        $privateProperty->className = \substr($key, 1, $nullPos - 1);

        return $privateProperty;
    }
}
