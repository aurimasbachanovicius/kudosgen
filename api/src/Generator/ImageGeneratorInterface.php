<?php

namespace Kudosgen\Generator;

interface ImageGeneratorInterface
{
    public function generate(GenerateRequest $request): ImageBlob;
}
