<?php

namespace Kudosgen;

interface EncoderInterface
{
    public function encode(string $string): string;
}
