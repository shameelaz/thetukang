<?php

namespace Overdrive\Web;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use App\Enums\Permission;
use DB;
use Overdrive\Web\Commands\AuthAssetCommand;

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

    protected $commands = [
        AuthAssetCommand::class,
       
    ];

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
        $this->commands($this->commands);

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
        $this->loadRoutesFrom(__DIR__.'/../routes/user.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/menu.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'web');
        $this->menu();
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang','web');

        $this->registerPublishables();

    }

    protected function registerPublishables(): void
    {
        $this->publishes(
           [\Web\web_path('stubs') => base_path()],
            ['overdrive-route']
        );
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