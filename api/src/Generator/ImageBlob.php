<?php

namespace Kudosgen\Generator;

class ImageBlob implements \Stringable
{
    public function __construct(private readonly ?string $blob)
    {
    }

    public function __toString(): string
    {
        return (string)$this->blob;
    }
}
