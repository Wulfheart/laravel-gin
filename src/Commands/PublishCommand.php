<?php

namespace Wulfheart\LaravelGin\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PublishCommand extends Command
{
    public $signature = 'laravel-gin:publish';

    public $description = 'Publish all assets';

    public function handle()
    {
        $path = public_path('vendor/laravel-gin');
        File::copyDirectory(Str::of(__DIR__)->finish('/') . '../../public', $path);
        $this->comment("Files copied to ${path}");
    }
}
