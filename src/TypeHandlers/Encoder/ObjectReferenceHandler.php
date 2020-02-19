<?php

namespace Eremin\SerEnDe\TypeHandlers\Encoder;

use Eremin\SerEnDe\Types\AbstractType;
use Eremin\SerEnDe\Types\ObjectReferenceType;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class ObjectReferenceHandler extends AbstractReferenceHandler
{
    public function supports(AbstractType $type): bool
    {
        return $type instanceof ObjectReferenceType;
    }
}
