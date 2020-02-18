<?php

namespace Eremin\SerEnDe;

use Eremin\SerEnDe\TypeHandlers\Encoder as TypeHandlers;
use Eremin\SerEnDe\TypeHandlers\ReferenceHandlerInterface;
use Eremin\SerEnDe\Types\AbstractType;

class EncoderInternal implements EncoderInternalInterface
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
        $this->typeHandlers = $typeHandlers;
        foreach ($typeHandlers as $handler) {
            if ($handler instanceof TypeHandlers\ComplexTypeHandler) {
                $handler->setEncoder($this);
            }
            if ($handler instanceof ReferenceHandlerInterface) {
                $handler->setReferenceMap($this->referenceMap);
            }
        }
    }

    public function encodeAndReferenceInternal(AbstractType $type): string
    {
        $this->referenceMap->addType($type);

        return $this->encodeInternal($type);
    }

    /**
     * @param AbstractType $type
     * @return string
     * @internal
     */
    public function encodeInternal(AbstractType $type): string
    {
        foreach ($this->typeHandlers as $typeHandler) {
            if ($typeHandler->supports($type)) {
                return $typeHandler->encodeType($type);
            }
        }

        throw new \InvalidArgumentException('Type ' . \get_class($type) . ' is not supported');
    }
}
