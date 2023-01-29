<?php

namespace ContainerBCPtx0w;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getMatchFormHandlerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\FormHandler\MatchFormHandler' shared autowired service.
     *
     * @return \App\FormHandler\MatchFormHandler
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'FormHandler'.\DIRECTORY_SEPARATOR.'MatchFormHandler.php';

        $a = ($container->services['doctrine.orm.default_entity_manager'] ?? $container->getDoctrine_Orm_DefaultEntityManagerService());

        if (isset($container->privates['App\\FormHandler\\MatchFormHandler'])) {
            return $container->privates['App\\FormHandler\\MatchFormHandler'];
        }

        return $container->privates['App\\FormHandler\\MatchFormHandler'] = new \App\FormHandler\MatchFormHandler($a);
    }
}
