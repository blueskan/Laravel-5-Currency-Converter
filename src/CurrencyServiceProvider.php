<?php namespace Senemoglu\Currency;

use Blade;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use Senemoglu\Currency\Services\JsonConvertService;

class CurrencyServiceProvider extends ServiceProvider {

    protected $defer = false;

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        $this->configuration();

        Blade::extend(function($view)
        {
            return preg_replace_callback('/(\s*)@currency\(([a-zA-Z]{3}) > ([a-zA-Z]{3})(, ([0-9]+)|)\)(\s*)/', function($holders) {
                return $holders[1] . $this->app['converter']->convert($holders[2], $holders[3], $holders[5]) . $holders[6];
            }, $view);
        });
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->singleton('converter', function() {
            return new Converter(new Client(), new JsonConvertService());
        });

    }

    protected function configuration()
    {
        $this->mergeConfigFrom(
            __DIR__. '/config.php', 'currency'
        );

        $this->publishes([
            __DIR__. '/config.php' => config_path('currency.php'),
        ]);
    }

}
