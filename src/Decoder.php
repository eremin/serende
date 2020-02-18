<?php

namespace Eremin\SerEnDe;

use Eremin\SerEnDe\TypeHandlers\Decoder as TypeHandlers;
use Eremin\SerEnDe\Types\AbstractType;

class Decoder implements DecoderInterface
{
    /**
     * @var TypeHandlers\TypeHandlerInterface[]
     */
    private $typeHandlers = [];

    public function __construct(TypeHandlers\TypeHandlerInterface ...$typeHandlers)
    {
        $this->typeHandlers = $typeHandlers;
    }

    public function decodeFromString(string $serialized): AbstractType
    {
        $string = SerializedString::createFromString($serialized);

        return $this->createDecoder()->decodeAndReferenceInternal($string);
    }

    /**
     * @return DecoderInternal
     */
    public function createDecoder(): DecoderInternal
    {
        return new DecoderInternal(...$this->typeHandlers);
    }

    /**
     * @param resource $stream
     */
    public function decodeFromStream($stream): AbstractType
    {
        $string = new SerializedString($stream);

        return $this->createDecoder()->decodeAndReferenceInternal($string);
    }
}
