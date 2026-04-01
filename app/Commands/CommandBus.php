<?php

namespace App\Commands;

class CommandBus
{
    public function handle($command)
    {
        $class = get_class($command) . 'Handler';

        $handler = app($class);

        $handler($command);
    }
}
