<?php

namespace Kudosgen;

/**
 * Encoder encodes the string and returns encoded string.
 */
interface EncoderInterface
{
    public function encode(string $string): string;
}
