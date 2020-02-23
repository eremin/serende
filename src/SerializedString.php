<?php

namespace Eremin\SerEnDe;

class SerializedString
{
    private $resource;

    public function __construct($resource)
    {
        if (!\is_resource($resource)) {
            throw new \InvalidArgumentException('This method accepts php streams only.');
        }
        $this->resource = $resource;
        \rewind($this->resource);
    }

    public static function createFromString(string $string): self
    {
        $resource = \fopen('php://temp', 'rb+');
        \fwrite($resource, $string);

        return new self($resource);
    }

    public function assertNextOne(string $assertedChar)
    {
        $char = $this->readOne();
        if ($char !== $assertedChar) {
            throw new \RuntimeException(
                "The next one character was not one was specified (got $char, excepted $assertedChar)."
            );
        }
    }

    public function readOne(): ?string
    {
        $char = \fgetc($this->resource);
        if (false === $char) {
            return null;
        }

        return $char;
    }

    public function readUntil(string $untilChar): string
    {
        $result = '';

        while (null !== ($char = $this->readOne())) {
            if ($untilChar === $char) {
                return $result;
            }
            $result .= $char;
        }

        throw new \RuntimeException('Excepted char was not reached before EOF.');
    }

    public function readByLength(int $length): string
    {
        if (0 === $length) {
            return '';
        }
        $string = \fread($this->resource, $length);
        if (false === $string || $length !== \strlen($string)) {
            throw new \RuntimeException('The stream was too short. Excepted length was not reached.');
        }
        return $string;
    }
}
