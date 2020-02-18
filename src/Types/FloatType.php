<?php


namespace Eremin\SerEnDe\Types;


final class FloatType extends AbstractType
{
    public const TYPE_LETTER = 'd';

    public function getValue(): float
    {
        return (float)$this->rawContent;
    }

    public function setValue(float $value): self
    {
        return $this->setValueHelper($value);
    }
}
