<?php

defined('_JEXEC') or die('Restricted access');

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
		$container->registerServiceProvider(new ComponentDispatcherFactory('\\RogackiS\\Component\\Sportowiada'));
		$container->registerServiceProvider(new MVCFactory('\\RogackiS\\Component\\Sportowiada'));

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