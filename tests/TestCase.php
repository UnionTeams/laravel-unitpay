<?php

namespace UnionTeams\UnitPay\Test;

use UnionTeams\UnitPay\UnitPay;
use UnionTeams\UnitPay\UnitPayServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    /**
     * @var UnitPay
     */
    protected $unitpay;

    public function setUp(): void
    {
        parent::setUp();

        $this->unitpay = $this->app['unitpay'];

        $this->app['config']->set('unitpay.public_key', 'public_key');
        $this->app['config']->set('unitpay.secret_key', 'secret_key');
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            UnitPayServiceProvider::class,
        ];
    }

    /**
     * @param array $config
     */
    protected function withConfig(array $config)
    {
        $this->app['config']->set($config);
        $this->app->forgetInstance(UnitPay::class);
        $this->unitpay = $this->app->make(UnitPay::class);
    }
}
