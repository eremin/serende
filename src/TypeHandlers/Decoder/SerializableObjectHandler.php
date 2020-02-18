<?php

namespace Eremin\SerEnDe\TypeHandlers\Decoder;

use Eremin\SerEnDe\ReferenceMap;
use Eremin\SerEnDe\SerializedString;
use Eremin\SerEnDe\Types\AbstractType;
use Eremin\SerEnDe\Types\SerializableObjectType;

class SerializableObjectHandler implements TypeHandlerInterface
{

    public function getTypeChar(): string
    {
        return SerializableObjectType::TYPE_LETTER;
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
        $content = $string->readByLength($length);
        $string->assertNextOne('}');

        $type = SerializableObjectType::createReferenced($referenceMap);
        $type->rawContent = $content;
        $type->className = $className;

        return $type;
    }
}
