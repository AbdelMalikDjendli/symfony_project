<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerFmA82vW\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerFmA82vW/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerFmA82vW.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerFmA82vW\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerFmA82vW\App_KernelDevDebugContainer([
    'container.build_hash' => 'FmA82vW',
    'container.build_id' => '8b6c2f2c',
    'container.build_time' => 1674992812,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerFmA82vW');
