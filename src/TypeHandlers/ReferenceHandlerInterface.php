<?php

namespace Eremin\SerEnDe\TypeHandlers;

use Eremin\SerEnDe\ReferenceMap;

interface ReferenceHandlerInterface
{
    public function setReferenceMap(ReferenceMap $referenceMap): void;
}
