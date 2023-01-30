<?php

namespace ContainerV1UZxZP;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getJoinMatchHandlerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\FormHandler\JoinMatchHandler' shared autowired service.
     *
     * @return \App\FormHandler\JoinMatchHandler
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'FormHandler'.\DIRECTORY_SEPARATOR.'JoinMatchHandler.php';

        $a = ($container->services['doctrine.orm.default_entity_manager'] ?? $container->getDoctrine_Orm_DefaultEntityManagerService());

        if (isset($container->privates['App\\FormHandler\\JoinMatchHandler'])) {
            return $container->privates['App\\FormHandler\\JoinMatchHandler'];
        }

        return $container->privates['App\\FormHandler\\JoinMatchHandler'] = new \App\FormHandler\JoinMatchHandler($a, ($container->services['doctrine'] ?? $container->getDoctrineService()));
    }
}
