<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('path.public', function() {
            return base_path().'/public_html';
        });

        //helpers
        foreach (glob(app_path().'/Helpers/*.php') as $filename){
            require_once($filename);
        }



    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        //$directives = require __DIR__.'/directives.php';
// dd($directives);

        Blade::directive('svg', function ($expression) {
            return "<?php echo svg({$expression}); ?>";
        });
        Blade::directive('icon', function ($expression) {
            return "<?php echo icon({$expression}); ?>";
        });


    }
}
