<?php

namespace Kudosgen\Core;

class Application
{
    public function __construct(private RouterInterface $router, RequestInterface $request)
    {
    }

    public function boot(): void
    {
    }
}
