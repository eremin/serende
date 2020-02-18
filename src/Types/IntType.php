<?php


namespace Eremin\SerEnDe\Types;


final class IntType extends AbstractType
{
    public const TYPE_LETTER = 'i';

    public function getValue(): int
    {
        return (int)$this->rawContent;
    }

    public function setValue(int $value): self
    {
        return $this->setValueHelper($value);
    }
}
