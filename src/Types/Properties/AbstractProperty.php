<?php

namespace Eremin\SerEnDe\Types\Properties;

use Eremin\SerEnDe\Types\AbstractType;

abstract class AbstractProperty
{
    /**
     * @var string
     */
    public $propertyName;
    /**
     * @var AbstractType
     */
    private $value;

    /**
     * @return AbstractType
     */
    public function getValue(): AbstractType
    {
        return $this->value;
    }

    /**
     * @param AbstractType $value
     *
     * @return $this
     */
    public function setValue(AbstractType $value): self
    {
        $this->value = $value;

        return $this;
    }
}
