<?php


namespace Eremin\SerEnDe\Types;


use Eremin\SerEnDe\Types\ArrayType\Element;

final class ArrayType extends AbstractType
{
    public const TYPE_LETTER = 'a';
    /**
     * @var Element[]
     */
    private $elements = [];

    /**
     * @return Element[]
     */
    public function getElements(): array
    {
        return $this->elements;
    }

    public function addElement(Element $element): self
    {
        $this->elements[] = $element;

        return $this;
    }

    public function removeElement(Element $element): self
    {
        foreach ($this->elements as $key => $value) {
            if ($element === $value) {
                \array_splice($this->elements, $key, 1);

                return $this;
            }
        }

        return $this;
    }

    public function getElementByKey($key): ?Element
    {
        foreach ($this->elements as $element) {
            if ($key === $element->getKey()->rawContent) {
                return $element;
            }
        }

        return null;
    }
}
