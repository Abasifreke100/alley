<?php

namespace Alley\Providers;

use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $path = base_path('modules/');
        $dirs =  glob($path.'*',GLOB_ONLYDIR);
        foreach ($dirs as $dir){
            list($base,$moduleDir) = explode($path,$dir);
            $migrationPath = $path.$moduleDir.'/Migrations';
            if(file_exists($migrationPath)){
                $this->loadMigrationsFrom($migrationPath);
            }

        }

    }
}
