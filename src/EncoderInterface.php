<?php

namespace Eremin\SerEnDe;

use Eremin\SerEnDe\Types\AbstractType;

interface EncoderInterface
{
    public function encode(AbstractType $type): string;
}
