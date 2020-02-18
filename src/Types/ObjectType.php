<?php


namespace Eremin\SerEnDe\Types;


use Eremin\SerEnDe\Types\Properties\AbstractProperty;
use Eremin\SerEnDe\Types\Properties\PrivateProperty;

final class ObjectType extends AbstractType
{
    public const TYPE_LETTER = 'O';
    /** @var string */
    public $className;

    /**
     * @var AbstractProperty[]
     */
    private $properties = [];

    /**
     * @return AbstractProperty[]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    public function addProperty(AbstractProperty $property): self
    {
        $this->properties[] = $property;

        return $this;
    }

    public function removeProperty(AbstractProperty $property): self
    {
        foreach ($this->properties as $key => $value) {
            if ($property === $value) {
                \array_splice($this->properties, $key, 1);

                return $this;
            }
        }

        return $this;
    }

    public function getPropertyByName(string $name): ?AbstractProperty
    {
        foreach ($this->properties as $property) {
            if ($name === $property->propertyName) {
                return $property;
            }
        }

        return null;
    }

    public function setClassNameWithAllProperties(string $className)
    {
        $this->className = $className;

        foreach ($this->properties as $property) {
            if ($property instanceof PrivateProperty) {
                $property->className = $className;
            }
        }
    }
}
