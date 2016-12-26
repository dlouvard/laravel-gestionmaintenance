<?php
namespace Dlouvard\LaravelGestionmaintenance;
/**
 * Created by PhpStorm.
 * User: dlouvard_imac
 * Date: 26/12/2016
 * Time: 18:44
 */
use Illuminate\Support\ServiceProvider;

class GestionmaintenanceServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'maintenances');
        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/maintenances'),
        ]);
        $this->publishes([
            __DIR__.'/Migrations/' => database_path('migrations')
        ], 'migrations');
        $this->publishes([
            __DIR__.'/assets/js' => public_path('vendor/maintenances'),
        ], 'public');
        include __DIR__ . '/helpers.php';
    }

    public function register()
    {

        $this->app->bind('gestionmaintenance', function ($app) {
            return new GestionMaintenance($app);
        });
        $this->app['router']->group(['namespace' => '\Dlouvard\LaravelGestionmaintenance\GestionMaintenanceController','middleware' => ['web']], function () {
            require __DIR__.'/routes.php';
        });


    }

    public function provides()
    {
        return ['gestionmaintenance'];
    }
}