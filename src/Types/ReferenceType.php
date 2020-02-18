<?php


namespace Eremin\SerEnDe\Types;


final class ReferenceType extends AbstractType
{
    public const TYPE_LETTER = 'R';
    /**
     * @var AbstractType
     */
    private $referencedType;

    /**
     * @return AbstractType
     */
    public function getReferencedType(): AbstractType
    {
        return $this->referencedType;
    }

    /**
     * @param AbstractType $referencedType
     * @return ReferenceType
     */
    public function setReferencedType(AbstractType $referencedType): ReferenceType
    {
        $this->referencedType = $referencedType;
        return $this;
    }
}
