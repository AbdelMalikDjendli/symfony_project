<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container9AMnQCI\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container9AMnQCI/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container9AMnQCI.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container9AMnQCI\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \Container9AMnQCI\App_KernelDevDebugContainer([
    'container.build_hash' => '9AMnQCI',
    'container.build_id' => '87f43e3a',
    'container.build_time' => 1675073540,
], __DIR__.\DIRECTORY_SEPARATOR.'Container9AMnQCI');