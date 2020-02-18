<?php

namespace Eremin\SerEnDe;

use Eremin\SerEnDe\TypeHandlers\Decoder as DecoderTH;
use Eremin\SerEnDe\TypeHandlers\Encoder as EncoderTH;

/**
 * Class Factory
 *
 * @SuppressWarnings(PHPMD)
 */
class Factory
{
    public static function createDecoder(): DecoderInterface
    {
        return new Decoder(
            new DecoderTH\NullHandler(),
            new DecoderTH\BoolHandler(),
            new DecoderTH\IntHandler(),
            new DecoderTH\FloatHandler(),
            new DecoderTH\ArrayHandler(),
            new DecoderTH\ReferenceHandler(),
            new DecoderTH\SerializableObjectHandler(),
            new DecoderTH\StringHandler(),
            new DecoderTH\ObjectHandler()
        );
    }

    public static function createEncoder(): EncoderInterface
    {
        return new Encoder(
            new EncoderTH\ArrayHandler(),
            new EncoderTH\BoolHandler(),
            new EncoderTH\IntHandler(),
            new EncoderTH\NullHandler(),
            new EncoderTH\FloatHandler(),
            new EncoderTH\ReferenceHandler(),
            new EncoderTH\SerializableObjectHandler(),
            new EncoderTH\StringHandler(),
            new EncoderTH\ObjectHandler()
        );
    }
}
