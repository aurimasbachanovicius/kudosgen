<?php

namespace Kudosgen;

class Base64Encoder implements EncoderInterface
{
    public function encode(string $string): string
    {
        return base64_encode($string);
    }
}
