<?php

namespace Kudosgen;

/**
 * Encoder encodes the string
 */
interface EncoderInterface
{
    public function encode(string $string): string;
}
