<?php

namespace Eremin\SerEnDe\TypeHandlers\Encoder;

use Eremin\SerEnDe\EncoderInternalInterface;
use Eremin\SerEnDe\Types\AbstractType;
use Eremin\SerEnDe\Types\ArrayType;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class ArrayHandler implements TypeHandlerInterface, ComplexTypeHandler
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
        return $type instanceof ArrayType;
    }

    public function encodeType(AbstractType $type): string
    {
        if (!$type instanceof ArrayType) {
            throw new \LogicException('The type should be ArrayType');
        }

        $elements = $type->getElements();
        $result = ArrayType::TYPE_LETTER . ':' . \count($elements) . ':{';

        foreach ($elements as $element) {
            $result .= $this->encoder->encodeInternal($element->getKey());
            $result .= $this->encoder->encodeAndReferenceInternal($element->getValue());
        }

        return $result . '}';
    }
}
