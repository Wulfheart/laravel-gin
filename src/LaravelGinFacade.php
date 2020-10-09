<?php

namespace Wulfheart\LaravelGin;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Wulfheart\LaravelGin\LaravelGin
 */
class LaravelGinFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-gin';
    }

    public function getModels(): Collection
    {
        $models = collect(File::allFiles(app_path()))
            ->map(function ($item) {
                $path = $item->getRelativePathName();
                $class = sprintf('\%s%s',
                    Container::getInstance()->getNamespace(),
                    strtr(substr($path, 0, strrpos($path, '.')), '/', '\\'));
    
                return $class;
            })
            ->filter(function ($class) {
                $valid = false;
    
                if (class_exists($class)) {
                    $reflection = new \ReflectionClass($class);
                    $valid = $reflection->isSubclassOf(Model::class) &&
                        !$reflection->isAbstract();
                }
    
                return $valid;
            });
    
        return $models->values();
    }
}
