<?php

namespace Eremin\SerEnDe;

use Eremin\SerEnDe\TypeHandlers\Decoder as TypeHandlers;
use Eremin\SerEnDe\Types\AbstractType;

class DecoderInternal implements DecoderInternalInterface
{
    /**
     * @var ReferenceMap
     */
    private $referenceMap;
    /**
     * @var TypeHandlers\TypeHandlerInterface[]
     */
    private $typeHandlers = [];

    public function __construct(TypeHandlers\TypeHandlerInterface ...$typeHandlers)
    {
        $this->referenceMap = new ReferenceMap();
        foreach ($typeHandlers as $handler) {
            $this->typeHandlers[$handler->getTypeChar()] = $handler;
            if ($handler instanceof TypeHandlers\ComplexTypeHandler) {
                $handler->setDecoder($this);
            }
        }
    }

    /**
     * @internal
     */
    public function decodeAndReferenceInternal(SerializedString $string): AbstractType
    {
        return $this->decodeInternal($string, $this->referenceMap);
    }

    /**
     * @internal
     */
    public function decodeInternal(SerializedString $string, ?ReferenceMap $referenceMap = null): AbstractType
    {
        $type = $string->readOne();
        if (isset($this->typeHandlers[$type])) {
            return $this->typeHandlers[$type]->parseType($string, $referenceMap);
        }
        throw new \RuntimeException("Unknown type $type. No handler was defined for it.");
    }
}
