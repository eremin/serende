<?php

namespace Eremin\SerEnDe\TypeHandlers\Encoder;

use Eremin\SerEnDe\ReferenceMap;
use Eremin\SerEnDe\TypeHandlers\ReferenceHandlerInterface;
use Eremin\SerEnDe\Types\AbstractReferenceType;
use Eremin\SerEnDe\Types\AbstractType;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
abstract class AbstractReferenceHandler implements TypeHandlerInterface, ReferenceHandlerInterface
{
    /**
     * @var ReferenceMap
     */
    private $referenceMap;

    public function setReferenceMap(ReferenceMap $referenceMap): void
    {
        $this->referenceMap = $referenceMap;
    }

    public function encodeType(AbstractType $type): string
    {
        if (!$type instanceof AbstractReferenceType) {
            throw new \LogicException('The type should be AbstractReferenceType');
        }

        $index = $this->referenceMap->getIndexOfType($type->getReferencedType());
        if (null === $index) {
            throw new \RuntimeException('Reference target was not encoded yet');
        }

        return $type::TYPE_LETTER . ":{$index};";
    }
}
