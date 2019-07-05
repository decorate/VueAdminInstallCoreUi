<?php

namespace Decorate\Providers;

use Decorate\AdminInstall;
use Decorate\CloneTemplate;
use Decorate\MakeAdminLogin;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class AdminInstallCoreUiProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__. '/../route/admin.php');
        $this->loadMigrationsFrom(__DIR__. '/../migration');

        $this->publishes([
            __DIR__.'/../route/admin.php' => base_path('/routes'),
            __DIR__.'/../migration/' => base_path('/database/migrations')
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.make.admin-login', function ($app) {
            return new MakeAdminLogin();
        });

        $this->commands('command.make.admin-login');

        $this->app->singleton('command.make.admin-install', function ($app) {
            return new AdminInstall();
        });

        $this->commands('command.make.admin-install');

        $this->app->singleton('command.make.clone-template', function ($app) {
            return new CloneTemplate();
        });

        $this->commands('command.make.clone-template');

        $this->mergeConfigFrom(__DIR__. '/../config/auth.php', 'auth');
    }

    protected function mergeConfigFrom($path, $key)
    {
        $config = $this->app['config']->get($key, []);
        $this->app['config']->set($key, $this->mergeConfig(require $path, $config));
    }

    protected function mergeConfig(array $original, array $merging)
    {
        $array = array_merge($original, $merging);
        foreach ($original as $key => $value) {
            if (! is_array($value)) {
                continue;
            }
            if (! Arr::exists($merging, $key)) {
                continue;
            }
            if (is_numeric($key)) {
                continue;
            }
            $array[$key] = $this->mergeConfig($value, $merging[$key]);
        }
        return $array;
    }
}
