<?php


namespace Eremin\SerEnDe\Types;


final class BoolType extends AbstractType
{
    public const TYPE_LETTER = 'b';

    public function getValue(): bool
    {
        return '1' === $this->rawContent;
    }

    public function setValue(bool $value): self
    {
        return $this->setValueHelper($value);
    }
}
