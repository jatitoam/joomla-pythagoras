<?php

namespace Joomla\Tests\Unit\Joomla\ServiceProvider;

use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use Joomla\Plugin\PluginFactoryInterface;
use Joomla\Joomla\ServiceProvider\EventDispatcherServiceProvider;

class EventDispatcherServiceProviderTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @testdox The EventDispatcherServiceProvider implements the
	 * ServiceProviderInterface interface
	 */
	public function testTheTestEventDispatcherServiceProviderImplementsTheServiceProviderInterface()
	{
		$this->assertInstanceOf(ServiceProviderInterface::class, new EventDispatcherServiceProvider());
	}

	/**
	 * @testdox The EventDispatcherServiceProvider adds an EventDispatcher to a
	 * container
	 */
	public function testEventDispatcherServiceProviderCreatesDispatcher()
	{
		$container = new Container();
		$container->set('plugin_factory', $this->getMockBuilder(PluginFactoryInterface::class)->getMock());

		$service = new EventDispatcherServiceProvider();
		$service->register($container);

		$this->assertInstanceOf(DispatcherInterface::class, $container->get('EventDispatcher'));
	}

	/**
	 * @testdox The EventDispatcherServiceProvider adds an EventDispatcher to a
	 * container with an alias
	 */
	public function testEventDispatcherServiceProviderCreatesDispatcherWithAlias()
	{
		$container = new Container();
		$container->set('plugin_factory', $this->getMockBuilder(PluginFactoryInterface::class)->getMock());

		$service = new EventDispatcherServiceProvider();
		$service->register($container, 'unit');

		$this->assertInstanceOf(DispatcherInterface::class, $container->get('unit'));
	}
}