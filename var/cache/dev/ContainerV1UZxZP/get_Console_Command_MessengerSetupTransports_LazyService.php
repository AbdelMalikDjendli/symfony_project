<?php

namespace ContainerV1UZxZP;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_Console_Command_MessengerSetupTransports_LazyService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.console.command.messenger_setup_transports.lazy' shared service.
     *
     * @return \Symfony\Component\Console\Command\LazyCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'symfony'.\DIRECTORY_SEPARATOR.'console'.\DIRECTORY_SEPARATOR.'Command'.\DIRECTORY_SEPARATOR.'Command.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'symfony'.\DIRECTORY_SEPARATOR.'console'.\DIRECTORY_SEPARATOR.'Command'.\DIRECTORY_SEPARATOR.'LazyCommand.php';

        return $container->privates['.console.command.messenger_setup_transports.lazy'] = new \Symfony\Component\Console\Command\LazyCommand('messenger:setup-transports', [], 'Prepare the required infrastructure for the transport', false, #[\Closure(name: 'console.command.messenger_setup_transports', class: 'Symfony\\Component\\Messenger\\Command\\SetupTransportsCommand')] function () use ($container): \Symfony\Component\Messenger\Command\SetupTransportsCommand {
            return ($container->privates['console.command.messenger_setup_transports'] ?? $container->load('getConsole_Command_MessengerSetupTransportsService'));
        });
    }
}
