<?php

namespace Bredi\Upload;

use Bredi\Upload\Upload\Upload;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class UploadServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadRoutesFrom(__DIR__ . '/Routes/routes.php');
        require __DIR__ . '/Routes/routes.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('upload', function () {
            return new Upload();
        });
    }
}
