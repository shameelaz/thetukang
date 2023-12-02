<?php

namespace Overdrive\Web\Commands;

use Illuminate\Console\Command;
use Overdrive\Web\Commands\AuthAssetCommand;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AuthAssetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'overide:asset {--refresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a symbolic link from "public/overide" to "web/asset"';

    /**
     * Execute the console command.
     *
     * @return mixed
     */


    public function handle()
    {
        if (!file_exists(public_path('overide/web'))) {
            
            mkdir(public_path('overide'));
            mkdir(public_path('overide/web'));
        }

        if (!file_exists(public_path('overide/web/themes'))) {
            $this->laravel->make('files')->link(
                \Web\web_path('vendor'),
                public_path('overide/web/themes')
            );
        }

        $this->info('The [public/overide/web/themes] directory has been linked.');

        $this->publishConfiguration($force = true);


        $this->info('The routing  auth file has being ovveriden.');

        $this->info('Synchronize Permissions Entries');

        $this->syncPermission(['*','laravolt::manage-user','laravolt::manage-role','laravolt::manage-permission','laravolt::manage-system','laravolt::manage-settings']);

        $this->info('Synchronize Permissions Successfull');

        $this->info('database migration');
        $this->call('migrate');
        $this->call('db:seed', ['--class' => 'Menu']);


       
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "Overdrive\Web\ServiceProvider",
            '--tag' => "overdrive-route"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

       $this->call('vendor:publish', $params);
    }

    public function syncPermission(array $permissions)
    {
        $refresh = true;

         // Schema::disableForeignKeyConstraints();
         //        app(config('laravolt.epicentrum.models.permission'))->truncate();
         //        Schema::enableForeignKeyConstraints();

        // $items = collect();

        $ids = collect($permissions)->transform(function ($name) {
            $items = collect();
            $permission = app(config('laravolt.epicentrum.models.permission'))->firstOrNew(['name' => $name]);
                $status = 'No Change';

                if (!$permission->exists) {
                    $permission->save();
                    $status = 'New';
                }

                $items->push(['id' => $permission->getKey(), 'name' => $name, 'status' => $status]);
                return $items;

        });



    }


}
