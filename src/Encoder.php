<?php

namespace Eremin\SerEnDe;

use Eremin\SerEnDe\TypeHandlers\Encoder as TypeHandlers;
use Eremin\SerEnDe\Types\AbstractType;

class Encoder implements EncoderInterface
{
    /**
     * @var TypeHandlers\TypeHandlerInterface[]
     */
    private $typeHandlers = [];

    public function __construct(TypeHandlers\TypeHandlerInterface ...$typeHandlers)
    {
        $this->typeHandlers = $typeHandlers;
    }

    public function encode(AbstractType $type): string
    {
        $encoder = new EncoderInternal(...$this->typeHandlers);

        return $encoder->encodeAndReferenceInternal($type);
    }
}
