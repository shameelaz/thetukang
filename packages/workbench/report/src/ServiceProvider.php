<?php

namespace Workbench\Report;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use App\Enums\Permission;
use DB;

/**
 * Class PackageServiceProvider
 *
 * @see http://laravel.com/docs/master/packages#service-providers
 * @see http://laravel.com/docs/master/providers
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @see http://laravel.com/docs/master/providers#deferred-providers
     * @var bool
     */
    protected $defer = false;

   /**
     * Register the service provider.
     *
     * @see http://laravel.com/docs/master/providers#the-register-method
     * @return void
     */
    protected $listen = [
        
        // \Workbench\Site\Events\EmailEvent::class => [
        //     \Workbench\Site\Handlers\Events\SentEmail::class
        // ],
    ];


    public function register()
    {
        
    }

    /**
     * Application is booting
     *
     * @see http://laravel.com/docs/master/providers#the-boot-method
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'report');
        $this->menu();
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang','report');

    }

    protected function menu()
    {

        //$menu = $this->app['laravolt.menu']->add(__('Dashboard'))->data('icon', 'clipboard list');
        //$menu->add(__('Dashboard Individu'), url('/index/'))
        //     ->data('icon', 'clipboard list')
        //     ->active('index/*')


        //$menu->add(__('Dashboard Tindakan'), url('dashboard/list/5'))
        //     ->data('icon', 'grid layout')
        //     ->active('dashboard/list/5')
        //     ->active('appl/views/*')
        //     ->data('permission', Permission::DASHBOARD_TINDAKAN);

       
    }
}