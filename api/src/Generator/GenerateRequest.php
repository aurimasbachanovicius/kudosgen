<?php

namespace Kudosgen\Generator;

class GenerateRequest
{
    public function __construct(
        private readonly string $from,
        private readonly string $to,
        private readonly string $message
    ) {
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
