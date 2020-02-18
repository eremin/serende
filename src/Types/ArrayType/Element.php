<?php

namespace Eremin\SerEnDe\Types\ArrayType;

use Eremin\SerEnDe\Types\AbstractType;
use Eremin\SerEnDe\Types\IntType;
use Eremin\SerEnDe\Types\StringType;

class Element
{
    /**
     * @var AbstractType
     */
    private $key;
    /**
     * @var AbstractType
     */
    private $value;

    /**
     * Element constructor.
     * @param AbstractType $key
     * @param AbstractType $value
     */
    public function __construct(AbstractType $key, AbstractType $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return AbstractType
     */
    public function getKey(): AbstractType
    {
        return $this->key;
    }

    /**
     * @param AbstractType $key
     *
     * @return $this
     */
    public function setKey(AbstractType $key): self
    {
        if ($key instanceof StringType || $key instanceof IntType) {
            $this->key = $key;

            return $this;
        }

        throw new \InvalidArgumentException('The key of array may be only int or string');
    }

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
