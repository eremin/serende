<?php

namespace Eremin\SerEnDe\TypeHandlers\Decoder;

use Eremin\SerEnDe\DecoderInternalInterface;
use Eremin\SerEnDe\ReferenceMap;
use Eremin\SerEnDe\SerializedString;
use Eremin\SerEnDe\Types\AbstractType;
use Eremin\SerEnDe\Types\ArrayType;
use Eremin\SerEnDe\Types\ArrayType\Element;

class ArrayHandler implements TypeHandlerInterface, ComplexTypeHandler
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
        return ArrayType::TYPE_LETTER;
    }

    public function parseType(SerializedString $string, ?ReferenceMap $referenceMap): AbstractType
    {
        $string->assertNextOne(':');
        $length = (int)$string->readUntil(':');
        $string->assertNextOne('{');

        $type = ArrayType::createReferenced($referenceMap);
        for ($counter = 0; $counter < $length; ++$counter) {
            $key = $this->decoder->decodeInternal($string);
            $value = $this->decoder->decodeAndReferenceInternal($string);
            $type->addElement(new Element($key, $value));
        }
        $string->assertNextOne('}');

        return $type;
    }
}
