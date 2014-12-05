<?php

namespace Tokenly\BitcoinAddressLib;


use Exception;
use Illuminate\Support\ServiceProvider;
use Tokenly\BitcoinAddressLib\BitcoinAddressGenerator;

/*
* BitcoinAddressServiceProvider
*/
class BitcoinAddressServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->package('tokenly/bitcoin-address-lib', 'bitcoin-address-lib', __DIR__.'/../../');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Tokenly\BitcoinAddressLib\BitcoinAddressGenerator', function($app) {
            $config = $app['config']['bitcoin-address-lib::bitcoin'];
            $generator = new BitcoinAddressGenerator($config['seed']);
            return $generator;
        });
    }

}

