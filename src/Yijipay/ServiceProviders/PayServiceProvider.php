<?php


namespace Yijipay\Yijipay\ServiceProviders;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Yijipay\Yijipay\Http\IRequest;
use Yijipay\Payment\Payment;

/**
 * Class MenuServiceProvider.
 */
class PayServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $pimple['pay'] = function ($pimple) {
            return new Payment($pimple['config']);
        };
    }
}
