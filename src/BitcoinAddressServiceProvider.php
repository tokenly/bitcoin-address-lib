<?php

namespace Tokenly\BitcoinAddressLib;


use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Tokenly\BitcoinAddressLib\BitcoinAddressGenerator;

/*
* BitcoinAddressServiceProvider
*/
class BitcoinAddressServiceProvider extends ServiceProvider
{

    public function boot()
    {
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->bindConfig();

        $this->app->bind('Tokenly\BitcoinAddressLib\BitcoinAddressGenerator', function($app) {
            $seed = Config::get('bitcoin-address-lib.seed');
            if (!$seed) { throw new Exception("A seed value is required for the bitcoin address generator", 1); }
            $generator = new BitcoinAddressGenerator($seed);
            return $generator;
        });
    }

    protected function bindConfig()
    {
        // simple config
        $config = [
            'bitcoin-address-lib.seed' => env('BITCOIN_MASTER_KEY'),
        ];

        // set the laravel config
        Config::set($config);
    }

}

