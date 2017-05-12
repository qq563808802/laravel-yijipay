<?php


namespace Yijipay\Yijipay\ServiceProviders;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Yijipay\Transfer\Transfer;

/**
 * Class MenuServiceProvider.
 */
class TransferServiceProvider implements ServiceProviderInterface
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
        $pimple['transfer'] = function ($pimple) {
            return new Transfer($pimple['config']);
        };
    }
}
