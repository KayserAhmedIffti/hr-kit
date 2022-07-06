<?php

namespace SkylarkSoft\HoneyComb\Authentication;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider as LaravelProvider;


class ServiceProvider extends LaravelProvider
{
    protected $rootPath;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->rootPath = realpath(__DIR__ . '/../');
    }

    public function boot()
    {
        $this->loadMigrationsFrom($this->rootPath . '/database/migrations');
        $this->loadViewsFrom($this->rootPath . '/resources/views', PackageConst::VIEW_NAMESPACE);
        $this->loadRoutesFrom($this->rootPath . '/routes/web.php');
        $this->loadRoutesFrom($this->rootPath . '/routes/api.php');
        $this->loadModuleConfig();
        $this->bindViewComposer();
        $this->publishAssets();
    }

    private function loadModuleConfig()
    {
        $this->mergeConfigFrom($this->rootPath . '/config/module.php', PackageConst::VIEW_NAMESPACE);
        $module = config(PackageConst::VIEW_NAMESPACE);
        $modules = config('erp.modules') ?? [];
        array_push($modules, $module);
    }

    private function bindViewComposer()
    {
        View::composer(PackageConst::VIEW_NAMESPACE . '::*', function ($view) {
            $view->with('viewPath', PackageConst::VIEW_NAMESPACE . '::');
        });
    }

    private function publishAssets()
    {
        $this->publishes([
            $this->rootPath . '/resources/assets' => public_path('modules/' . PackageConst::PACKAGE_NAME),
        ], 'public');
    }
}
