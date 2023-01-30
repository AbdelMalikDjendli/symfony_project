<?php

namespace ContainerMRciufs;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_H1nypSQService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.H1nypSQ' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.H1nypSQ'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'joinMatchHandler' => ['privates', 'App\\FormHandler\\JoinMatchHandler', 'getJoinMatchHandlerService', true],
        ], [
            'joinMatchHandler' => 'App\\FormHandler\\JoinMatchHandler',
        ]);
    }
}
