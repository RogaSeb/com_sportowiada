<?php

use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use RogackiS\Component\Sportowiada\Administrator\Extension\SportowiadaComponent;

return new class implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        // Rejestracja fabryki dispatcherów komponentu
        $container->registerServiceProvider(new ComponentDispatcherFactory('\\RogackiS\\Component\\Sportowiada'));

        // Rejestracja fabryki MVC
        $container->registerServiceProvider(new MVCFactory('\\RogackiS\\Component\\Sportowiada'));

        // Rejestracja głównego interfejsu komponentu
        $container->set(
            ComponentInterface::class,
            function (Container $container)
            {
                $component = new SportowiadaComponent($container->get(ComponentDispatcherFactoryInterface::class));
                $component->setMVCFactory($container->get(MVCFactoryInterface::class));

                return $component;
            }
        );
    }
};
