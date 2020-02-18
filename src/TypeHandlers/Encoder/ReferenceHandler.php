<?php

namespace Eremin\SerEnDe\TypeHandlers\Encoder;

use Eremin\SerEnDe\ReferenceMap;
use Eremin\SerEnDe\TypeHandlers\ReferenceHandlerInterface;
use Eremin\SerEnDe\Types\AbstractType;
use Eremin\SerEnDe\Types\ReferenceType;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class ReferenceHandler implements TypeHandlerInterface, ReferenceHandlerInterface
{
    /**
     * @var ReferenceMap
     */
    private $referenceMap;

    public function setReferenceMap(ReferenceMap $referenceMap): void
    {
        $this->referenceMap = $referenceMap;
    }

    public function supports(AbstractType $type): bool
    {
        return $type instanceof ReferenceType;
    }

    public function encodeType(AbstractType $type): string
    {
        if (!$type instanceof ReferenceType) {
            throw new \LogicException('The type should be ReferenceType');
        }

        $index = $this->referenceMap->getIndexOfType($type->getReferencedType());
        if (null === $index) {
            throw new \RuntimeException('Reference target was not encoded yet');
        }

        return ReferenceType::TYPE_LETTER . ":{$index};";
    }
}
