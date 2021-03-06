<?php

namespace Eremin\SerEnDe\TypeHandlers\Encoder;

use Eremin\SerEnDe\Types\AbstractType;
use Eremin\SerEnDe\Types\ReferenceType;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class ReferenceHandler extends AbstractReferenceHandler
{
    public function supports(AbstractType $type): bool
    {
        return $type instanceof ReferenceType;
    }
}
