<?php

namespace Wulfheart\LaravelGin\Commands;

use Illuminate\Console\Command;

class LaravelGinCommand extends Command
{
    public $signature = 'laravel-gin';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
