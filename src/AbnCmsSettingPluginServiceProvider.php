<?php

namespace Aman5537jains\AbnCmsSettingPlugin;


use Illuminate\Support\ServiceProvider;

class AbnCmsSettingPluginServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'AbnCmsSetting');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }



    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
